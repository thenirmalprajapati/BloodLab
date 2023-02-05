@php
    $howIt = getContent('how_it_work.content', true);
    $howItElements = getContent('how_it_work.element', false);
@endphp

<section class="pt-80 pb-80 dark--overlay bg_img" style="background-image: url('{{getImage('assets/images/frontend/how_it_work/'. @$howIt->data_values->background_image, '1920x1440')}}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title text-white">{{__(@$howIt->data_values->heading)}}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-5">
            @foreach($howItElements as $howItElement)
                <div class="col-lg-3 col-sm-6 work-card">
                    <div class="work-item">
                        <div class="work-item__icon">
                            <span class="step">{{$loop->iteration}}</span>
                            @php echo $howItElement->data_values->icon @endphp
                        </div>
                        <h5 class="work-item__title text-white">{{__($howItElement->data_values->title)}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
