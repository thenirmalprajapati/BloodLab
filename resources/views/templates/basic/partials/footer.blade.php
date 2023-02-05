@php
    $footer = getContent('footer.content', true);
    $contact = getContent('contact_us.content', true);
    $policys = getContent('policy_pages.element', false);
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp

@if(!session('cookie_accepted'))
    <div class="cookie__wrapper">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-between">
            <p class="txt my-2">
               @php echo @$cookie->data_values->description @endphp
              <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
            </p>
              <a href="javascript:void(0)" class="btn btn--base my-2 policy">@lang('Accept')</a>
          </div>
        </div>
    </div>
@endif

<footer class="footer img-overlay bg_img" style="background-image: url({{getImage('assets/images/frontend/footer/'. @$footer->data_values->background_image, '1920x921')}});">
    <div class="footer__top">
        <div class="container">
            <div class="footer-info-area">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-9">
                        <ul class="footer-contact-list justify-content-lg-start justify-content-center">
                        <li>
                                <div class="icon">
                                    <i class="las la-phone-volume"></i>
                                </div>
                                <div class="content">
                                    <!-- <a href="tel:{{__($contact->data_values->contact_number)}}">{{__($contact->data_values->contact_number)}}</a> -->
                                    <a href="tel:{{__($contact->data_values->contact_number)}}">+91 9726022648</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="las la-envelope"></i>
                                </div>
                                <div class="content">
                                    <!-- <a href="mailto:{{__($contact->data_values->email_address)}}">{{__($contact->data_values->email_address)}}</a> -->
                                    <a href="mailto:{{__($contact->data_values->email_address)}}">inquiry4.blood@gmail.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 text-lg-end text-center">
                        <a href="{{url($footer->data_values->btn_url)}}" class="btn btn--base">{{__($footer->data_values->btn_name)}}</a>
                    </div>
                </div>
            </div>

            <div class="row gy-5 justify-content-between">
                <div class="col-xl-4 col-lg-4 col-sm-8 order-lg-1 order-1">
                    <div class="footer-widget">
                        <a href="{{route('home')}}" class="footer-logo"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')"></a>
                        <p class="mt-3">{{__($footer->data_values->title)}}</p>
                        <form class="subscribe-form mt-4">
                            <input type="email" name="email" id="emailSub" class="form--control" placeholder="@lang('Enter email address')">
                            <button type="button" class="subscribe-btn"><i class="lab la-telegram-plane"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6 order-lg-2 order-3">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Short Links')</h4>
                        <ul class="footer-links-list">
                            @foreach($pages as $k => $data)
                                <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6 order-lg-3 order-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Support')</h4>
                        <ul class="footer-links-list">
                            <!-- <li><a href="{{route('contact')}}">@lang('Support Center')</a></li> -->
                            <li><a href="{{route('apply.donor')}}">@lang('Apply as a Donor')</a></li>
                            @foreach($policys as $policy)
                                <li><a href="{{route('footer.menu', [slug($policy->data_values->title), $policy->id])}}">{{__($policy->data_values->title)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-4 order-lg-4 order-2">
                    <div class="footer-widget">
                        <ul class="footer-overview-list text-end">
                            <li class="footer-overview">
                                <h4 class="footer-overview__number">{{__($footer->data_values->first_count_digits)}}</h4>
                                <p class="footer-overview__caption">{{__($footer->data_values->first_count_title)}}</p>
                            </li>
                            <li class="footer-overview">
                                <h4 class="footer-overview__number">{{__($footer->data_values->second_count_digits)}}</h4>
                                <p class="footer-overview__caption">{{__($footer->data_values->second_count_title)}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>@lang('Copyright') © {{Carbon\Carbon::now()->format('Y')}} <a href="{{ route('home') }}" class="text--base"> {{__($general->sitename)}} </a> @lang('All Right Reserved')</p>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('script')
<script>
    (function () {
        'use strict';
        $(document).on('click','.subscribe-btn' , function(){
            var email = $("#emailSub").val();
            if(email){
                $.ajax({
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}",},
                    url:"{{ route('subscribe') }}",
                    method:"POST",
                    data:{email:email},
                    success:function(response)
                    {
                        if(response.success) {
                            notify('success', response.success);
                            $("#emailSub").val('');
                        }else{
                            $.each(response, function (i, val) {
                                notify('error', val);
                            });
                        }
                    }
                });
            }
            else{
                notify('error', "Please Input Your Email");
            }
        });

        $('.policy').on('click',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{{route('cookie.accept')}}', function(response){
                $('.cookie__wrapper').addClass('d-none');
                notify('success', response);
            });
        });
    })();
</script>
@endpush