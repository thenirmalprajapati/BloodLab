@php
    $donor = getContent('donor.content', true);
    $donors = App\Models\Donor::where('status', 1)->orderBy('total_donate', 'DESC')->with('blood')->limit(8)->get();
@endphp

<section class="pt-100 pb-100 border-top  position-relative z-index-2 overflow-hidden">
    <div class="bottom-el-bg">
        <img src="{{getImage('assets/images/frontend/donor/'. @$donor->data_values->background_image, '1920x596')}}" alt="@lang('image')">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$donor->data_values->heading)}}</h2>
                    <p class="mt-2">{{__($donor->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @foreach($donors as $donor)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="donor-card style--two has--link section--bg2">
                        <a href="{{route('donor.details', [slug($donor->name), encrypt($donor->id)])}}" class="item--link"></a>
                        <div class="donor-card__thumb">
                            <img src="{{getImage('assets/images/donor/'. $donor->image, imagePath()['donor']['size'])}}" alt="@lang('image')">
                        </div>
                        <div class="donor-card__content">
                            <h6 class="donor-card__name">{{__($donor->name)}}</h6>
                            <p class="fs--14px text-white">@lang('Blood Group') : <span class="text--base">({{__($donor->blood->name)}})</span></p>
                            <ul class="d-flex flex-wrap align-items-center justify-content-center donor-card__social mt-1">
                                <li><a href="{{__(@$donor->socialMedia->facebook)}}" target="_blank"><i class="lab la-facebook-f"></i></a></li>
                                <li><a href="{{__(@$donor->socialMedia->twitter)}}" target="_blank"><i class="lab la-twitter"></i></a></li>
                                <li><a href="{{__(@$donor->socialMedia->linkedinIn)}}" target="_blank" ><i class="lab la-linkedin-in"></i></a></li>
                                <li><a href="{{__(@$donor->socialMedia->instagram)}}" target="_blank"><i class="lab la-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
   