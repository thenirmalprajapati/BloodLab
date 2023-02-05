
@php
    $about = getContent('about.content', true);
    $aboutElement = getContent('about.element', false);
@endphp

<section class="pt-100 pb-100 shade--bg">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-6">
                <div class="about-thumb">
                    <a class="play-btn" href="{{__(@$about->data_values->video_link)}}" data-rel="lightcase:myCollection"><i class="las la-play"></i></a>
                    <img src="{{getImage('assets/images/frontend/about/'. @$about->data_values->about_image, '992x661')}}" alt="@lang('image')" class="w-100 h-100">
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5">
                <div class="section-header mb-5 text-sm-start text-center">
                    <h2 class="section-title">{{__(@$about->data_values->heading)}}</h2>
                    <p>{{__(@$about->data_values->sub_heading)}}</p>
                </div>
                <div class="row gy-4">
                    @foreach($aboutElement as $value)
                        <div class="col-lg-12">
                            <div class="about-item">
                                <div class="about-item__icon">
                                    @php echo $value->data_values->about_icon @endphp
                                </div>
                                <div class="about-item__content">
                                    <h4 class="about-item__title">{{__($value->data_values->title)}}</h4>
                                    <p>{{__($value->data_values->sub_title)}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
