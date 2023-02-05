@php
    $blood = getContent('blood.content', true);
    $bloods = App\Models\Blood::where('status', 1)->with('donor')->get();
@endphp

<section class="pt-80 pb-80 position-relative z-index-2 overflow-hidden">
    <div class="top-el-bg">
        <img src="{{getImage('assets/images/frontend/blood/'. @$blood->data_values->background_image, '1920x389')}}" alt="@lang('image')">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header mb-5">
                    <h2 class="section-title">{{__(@$blood->data_values->heading)}}</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @foreach($bloods as $blood)
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="avaiable-blood-single has--link">
                        <a href="{{route('blood.group.donor', [slug($blood->name), encrypt($blood->id)])}}" class="item--link"></a>
                        <h6 class="avaiable-blood-single__name"><i class="las la-tint"></i>{{__($blood->name)}}</h6>
                        <span class="avaiable-blood-single__amount">{{$blood->donor->count()}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>