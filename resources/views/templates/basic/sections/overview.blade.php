@php
    $overview = getContent('overview.content', true);
    $overviewElements = getContent('overview.element', false);
@endphp

<section class="pt-80 pb-80 img-overlay bg_img" style="background-image: url('{{getImage('assets/images/frontend/overview/'. @$overview->data_values->background_image, '1920x1282')}}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title text-white fw-normal">{{__(@$overview->data_values->heading)}}</h2>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            @foreach($overviewElements as $overviewElement)
                <div class="col-lg-3 col-6">
                    <div class="overview-item text-center">
                        <div class="overview-item__icon">
                            @php echo $overviewElement->data_values->overview_icon @endphp
                        </div>
                        <h6 class="overview-item__caption">{{__($overviewElement->data_values->title)}}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

