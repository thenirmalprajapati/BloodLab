<?php

namespace App\Http\Controllers;

use App\Mail\HelloEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Models\AdminPasswordReset;
class MailGunController extends Controller
{
    //
    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        
        $user = Admin::where('email', $request->email)->first();
        // dD($user);
        if (!$user) {
            return back()->withErrors(['Email Not Available']);
        }

        $code = verificationCode(6);
        $adminPasswordReset = new AdminPasswordReset();
        $adminPasswordReset->email = $user->email;
        $adminPasswordReset->token = $code;
        $adminPasswordReset->status = 0;
        $adminPasswordReset->created_at = date("Y-m-d h:i:s");
        $adminPasswordReset->save();

        
        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        // // sendEmail($user, 'PASS_RESET_CODE', [
        // //     'code' => $code,
        // //     'operating_system' => $userBrowser['os_platform'],
        // //     'browser' => $userBrowser['browser'],
        // //     'ip' => $userIpInfo['ip'],
        // //     'time' => $userIpInfo['time']
        // // ]);
        $reveiverEmailAddress  = $user->email;
        // dd($reveiverEmailAddress);
        // // Mail::to($reveiverEmailAddress)->send(new HelloEmail);
        $data = [
            'email'   => $reveiverEmailAddress,
            'subject' => "Password Reset Code",
            'body'    => "Your password reset code is: $code",
        ];
        Mail::send([], $data, function($message) use ($data)
        {
                
            $message->from(env('MAIL_USERNAME'));
            $message->to($data['email']);
            $message->subject($data['subject']);
            $message->setBody($data["body"]); 
        });
        $pageTitle = 'Account Recovery';
        $notify[] = ['success', 'Password reset email sent successfully'];
        return view('admin.auth.passwords.code_verify', compact('pageTitle', 'notify'));
    }
    public function sendEmail()
    {
        /** 
         * Store a receiver email address to a variable.
         */
        $reveiverEmailAddress = "darshnayakpara@duck.com";

        /**
         * Import the Mail class at the top of this page,
         * and call the to() method for passing the 
         * receiver email address.
         * 
         * Also, call the send() method to incloude the
         * HelloEmail class that contains the email template.
         */
        Mail::to($reveiverEmailAddress)->send(new HelloEmail);

        /**
         * Check if the email has been sent successfully, or not.
         * Return the appropriate message.
         */
        if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";
    }
}
