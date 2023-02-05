<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use App\Models\Blood;
use App\Models\City;
use App\Models\Donor;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Location;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloEmail;
use App\Models\Admin;
use App\Models\AdminPasswordReset;

class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }
        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }
        $pageTitle = 'Home';
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','home')->first();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->get();
        return view($this->activeTemplate . 'home', compact('pageTitle','sections', 'bloods', 'cities'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle','sections'));
    }

    public function donor()
    {
        $pageTitle = "All Donor";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $donors = Donor::where('status',1)->with('blood', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'donor', compact('pageTitle','emptyMessage', 'donors', 'cities', 'bloods'));
    }

    public function donorDetails($slug, $id)
    {
        $pageTitle = "Donor Details";
        $donor = Donor::where('status',1)->where('id', decrypt($id))->firstOrFail();
        return view($this->activeTemplate . 'donor_details', compact('pageTitle', 'donor'));
    }

    public function donorSearch(Request $request)
    {
        $request->validate([
            'location_id' => 'nullable|exists:locations,id',
            'city_id' => 'nullable|exists:cities,id',
            'blood_id' => 'nullable|exists:bloods,id',
            'gender' => 'nullable|in:1,2'
        ]);
        $locations = Location::where('status', 1)->select('id', 'name')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->get();
        $pageTitle = "Donor Search";
        $emptyMessage = "No data found";
        $locationId = $request->location_id;
        $cityId = $request->city_id;
        $bloodId = $request->blood_id;
        $gender = $request->gender;
        $donors = Donor::where('status', 1);
        if($request->blood_id){
            $donors = $donors->where('blood_id', $request->blood_id);
        }
        if($request->city_id){
            $donors = $donors->where('city_id', $request->city_id);
        }
        if($request->location_id){
            $donors = $donors->where('location_id', $request->location_id);
        }
        if($request->gender){
            $donors = $donors->where('gender', $request->gender);
        }
        $donors = $donors->with('blood', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'donor', compact('pageTitle','emptyMessage', 'donors', 'cities', 'locations', 'bloods', 'locationId', 'cityId', 'bloodId', 'gender'));
    }

    public function contactWithDonor(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'name' => 'required|max:80',
            'email' => 'required|max:80',
            'message' => 'required|max:500'
        ]);
        $donor = Donor::findOrFail($request->donor_id);
        notify($donor, 'DONOR_CONTACT',[
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        $emailFrom  = $request->email;
        $nameFrom   = $request->name;
        $emailTo    = $donor->email;
        $messageFrom = $request->message;
        $adminEmail = env('MAIL_USERNAME');
      
        $data = [
            'emailto'   => $donor->email,
            'subject' => "New Contact Request",
            'body'    => "You have a new contact request from $nameFrom ($emailFrom). Message: $messageFrom",
        ];
        Mail::send([], $data, function($message) use ($data)
        {
                
            $message->from(env('MAIL_USERNAME'));
            $message->to($data['emailto']);
            $message->subject($data['subject']);
            $message->setBody($data["body"]); 
        });
        if (Mail::failures() != 0) {
            $notify[] = ['success', 'Request has been submitted'];
        }else
        {
            $notify[] = ['error', 'Something went wrong'];
        }
        
        return back()->withNotify($notify);
    }

    public function bloodGroup($slug, $id)
    {
        $blood = Blood::where('status', 1)->where('id', decrypt($id))->firstOrFail();
        $pageTitle = $blood->name." Blood Group Donor";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->get();
        $locations = Location::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status',1)->where('blood_id', $blood->id)->with('blood', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'donor', compact('pageTitle','emptyMessage', 'donors', 'bloods', 'cities', 'locations'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','contact')->first();
        return view($this->activeTemplate . 'contact',compact('pageTitle', 'sections'));
    }

    public function contactSubmit(Request $request)
    {
        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);
        $random = getNumber();
        $ticket = new SupportTicket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;

        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();
        
        $notify[] = ['success', 'ticket created successfully!'];
        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blog(){
        $pageTitle = "Blog";
        $blogs = Frontend::where('data_keys','blog.element')->paginate(9);
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','blog')->first();
        return view($this->activeTemplate.'blog',compact('blogs','pageTitle', 'sections'));
    }

    public function blogDetails($id,$slug){
        $blogs = Frontend::where('data_keys','blog.element')->latest()->limit(6)->get();
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $pageTitle = "Blog Details";
        return view($this->activeTemplate.'blog_details',compact('blog','pageTitle', 'blogs'));
    }

    public function footerMenu($slug, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle =  $data->data_values->title;
        return view($this->activeTemplate . 'menu', compact('data', 'pageTitle'));
    }

    public function cookieAccept(){
        session()->put('cookie_accepted',true);
        $notify = 'Cookie accepted successfully';
        return response()->json($notify);
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function applyDonor()
    {
        $pageTitle = "Apply as a Donor";
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view($this->activeTemplate.'apply_donor',compact('pageTitle', 'bloods', 'cities'));
    }

    public function applyDonorstore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|max:60|unique:donors,email',
            'phone' => 'required|max:40|unique:donors,phone',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'blood' => 'required|exists:bloods,id',
            'gender' => 'required|in:1,2',
            'religion' => 'required|max:40',
            'profession' => 'required|max:80',
            'donate' => 'required|integer',
            'address' => 'required|max:255',
            'details' => 'required',
            'birth_date' => 'required|date',
            'last_donate' => 'required|date',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedinIn' => 'required',
            'instagram' => 'required',
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $donor = new Donor();
        $donor->name = $request->name;
        $donor->email = $request->email;
        $donor->phone = $request->phone;
        $donor->city_id = $request->city;
        $donor->blood_id = $request->blood;
        $donor->location_id = $request->location;
        $donor->gender = $request->gender;
        $donor->religion = $request->religion;
        $donor->profession = $request->profession;
        $donor->address = $request->address;
        $donor->details = $request->details;
        $donor->total_donate = $request->donate;
        $donor->birth_date =  $request->birth_date;
        $donor->last_donate = $request->last_donate;
        $socialMedia = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedinIn' => $request->linkedinIn,
            'instagram' => $request->instagram
        ];
        $donor->socialMedia = $socialMedia;
        $path = imagePath()['donor']['path'];
        $size = imagePath()['donor']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $donor->image = $filename;
        }
        $donor->save();
        $notify[] = ['success', 'Your Requested Submitted'];
        return back()->withNotify($notify);
    }

    public function adclicked($id)
    {
        $ads = Advertisement::where('id', decrypt($id))->firstOrFail();
        $ads->click +=1;
        $ads->save();
        return redirect($ads->redirect_url);
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        $if_exist = Subscriber::where('email', $request->email)->first();
        if (!$if_exist) {
            Subscriber::create([
                'email' => $request->email
            ]);
            return response()->json(['success' => 'Subscribed Successfully']);
        }else {
            return response()->json(['error' => 'Already Subscribed']);
        }
    }

}
