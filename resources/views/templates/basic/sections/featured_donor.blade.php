@php
    $donor = getContent('featured_donor.content', true);
    $donors = App\Models\Donor::where('status', 1)->where('featured', 1)->with('blood')->inRandomOrder()->get();
@endphp

<section class="pt-100 pb-100 border-top  position-relative z-index-2 overflow-hidden">
    <div class="bottom-el-bg">
        <img src="{{getImage('assets/images/frontend/featured_donor/'. @$donor->data_values->background_image, '1920x596')}}" alt="@lang('image')">
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

        <div class="donor-slider">
            @foreach($donors as $donor)
                <div class="single-slide">
                    <div class="donor-card has--link">
                        <a href="{{route('donor.details', [slug($donor->name), encrypt($donor->id)])}}" class="item--link"></a>
                        <div class="donor-card__thumb">
                            <img src="{{getImage('assets/images/donor/'. $donor->image, imagePath()['donor']['size'])}}" alt="@lang('image')">
                        </div>
                        <div class="donor-card__content">
                            <h6 class="donor-card__name">{{__($donor->name)}}</h6>
                            <p class="text-white fs--14px">@lang('Blood Group') : ({{__($donor->blood->name)}})</p>
                            <span class="donor-card__amount mt-1"><i class="las la-tint"></i> {{__($donor->total_donate)}} @lang('Times')</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
   