@php
    $testimonial = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', false);
@endphp

<section class="pt-100 pb-100 bg_img dark--overlay overflow-hidden" style="background-image: url({{getImage('assets/images/frontend/testimonial/'. @$testimonial->data_values->background_image, '1920x1280')}});">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="section-header text-center">
                    <h2 class="section-title  text-white">{{__($testimonial->data_values->heading)}}</h2>
                    <p class="mt-2 text-white">{{__($testimonial->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>

        <div class="testimonial-slider">
            @foreach($testimonialElements as $testimonialElement)
                <div class="single-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-card__content">
                            <div class="ratings mb-2">
                                @if($testimonialElement->data_values->rating == 1)
                                    <i class="las la-star"></i>
                                @elseif($testimonialElement->data_values->rating == 2)
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                @elseif($testimonialElement->data_values->rating == 3)
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                @elseif($testimonialElement->data_values->rating == 4)
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                @elseif($testimonialElement->data_values->rating == 5)
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                @endif

                            </div>
                            <p>{{__($testimonialElement->data_values->testimonial)}}</p>
                            <div class="d-flex align-items-center mt-3">
                                <h5 class="name me-2">{{__($testimonialElement->data_values->name)}}</h5>
                                <span class="caption fs--14px text--base">({{$testimonialElement->data_values->donor_count}} @lang('times donor'))</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
