@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $banner = getContent('banner.content', true);
@endphp

<section class="hero bg_img" style="background-image: url({{getImage('assets/images/frontend/banner/'. @$banner->data_values->background_image, '1920x1280')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8 text-center">
                <h2 class="hero__title">{{__(@$banner->data_values->heading)}}</h2>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-xxl-7 col-xl-8 col-lg-10">
                <form method="GET" action="{{route('donor.search')}}" class="hero__blood-search-form">
                    <div class="input-field">
                        <i class="las la-tint"></i>
                        <select name="blood_id">
                            <option value="" selected="" disabled="">@lang('Select Blood Group')</option>
                            @foreach($bloods as $blood)
                                <option value="{{__($blood->id)}}">{{__($blood->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field">
                        <i class="las la-city"></i>
                        <select name="city_id">
                            <option value="" selected="" disabled="">@lang('Select City')</option>
                            @foreach($cities as $city)
                                <option value="{{__($city->id)}}">{{__($city->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-area">
                        <button type="submit" class="btn btn-md btn--base"><i class="las la-search"></i> @lang('Search')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if($sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include($activeTemplate.'sections.'.$sec)
    @endforeach
@endif
@endsection
