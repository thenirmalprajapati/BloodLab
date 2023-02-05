@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $contact = getContent('contact_us.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-100 pb-100 position-relative z-index shade--bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <span class="subtitle fw-bold text--base font-size--18px border-left">@lang('Contact with us')</span>
                    <h2 class="section-title">{{__($contact->data_values->title)}}</h2>
                </div>
            </div>
        </div>
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-wrapper-content section--bg2 h-100">
                        <h4 class="title text-white mb-4">@lang('Reach Us')</h4>
                        <ul class="contact-info-list">
                            <li class="single-info d-flex flex-wrap align-items-center">
                                <div class="single-info__icon text-white d-flex justify-content-center align-items-center rounded-3">
                                    <i class="las la-map-marked-alt"></i>
                                </div>
                                <div class="single-info__content">
                                    <p>Katargam, Surat.</p>
                                </div> 
                            </li>

                            <li class="single-info d-flex flex-wrap align-items-center">
                                <div class="single-info__icon text-white d-flex justify-content-center align-items-center rounded-3">
                                    <i class="las la-envelope"></i>
                                </div>
                                <div class="single-info__content">
                                    <p><a href="mailto:{{__($contact->data_values->email_address)}}">inquiry4.blood@gmail.com</a></p>
                                </div> 
                            </li>

                            <li class="single-info d-flex flex-wrap align-items-center">
                                <div class="single-info__icon text-white d-flex justify-content-center align-items-center rounded-3">
                                    <i class="las la-phone-volume"></i>
                                </div>
                                <div class="single-info__content">
                                    <p><a href="tel:{{__($contact->data_values->contact_number)}}">+91 9726022648</a></p>
                                </div> 
                            </li>
                            
                        </ul>
                        <div class="map-area mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29752.380582314992!2d72.8302353!3d21.229962049999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04eeb5c1077c1%3A0xf3db03f8cc74c359!2sKatargam%2C%20Surat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1675283181845!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="POST" action="" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-xl-6">
                                <label>@lang('Name') <sup class="text--danger">*</sup></label>
                                <input type="text" name="name" placeholder="@lang('Full name')" value="{{old('name')}}" class="form--control" required="">
                            </div>
                            <div class="form-group col-xl-6">
                                <label>@lang('Email') <sup class="text--danger">*</sup></label>
                                <input type="email" name="email" placeholder="@lang('Email address')" value="{{old('email')}}" class="form--control" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <label>@lang('Subject') <sup class="text--danger">*</sup></label>
                                <input type="text" name="subject" placeholder="@lang('Enter Subject')" value="{{old('subject')}}" class="form--control" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <label>@lang('Message') <sup class="text--danger">*</sup></label>
                                <textarea name="message" placeholder="@lang('Your message')" class="form--control" required="">{{old('message')}}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit Now')</button>
                            </div>
                        </div>
                    </form>
                </div>
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
