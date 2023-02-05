@php
    $patner = getContent('patner.content', true);
    $patnerElements = getContent('patner.element', false);
@endphp

<section class="pt-100 pb-100 shade--bg2 overflow-hidden">
    <div class="container border-bottom">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$patner->data_values->heading)}}</h2>
                    <p>{{__(@$patner->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="brand-slider">
            @foreach($patnerElements as $patnerElement)
                <div class="single-slide">
                    <div class="partner-item">
                        <img src="{{getImage('assets/images/frontend/patner/'. @$patnerElement->data_values->background_image, '255x241')}}" alt="@lang('image')">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


 