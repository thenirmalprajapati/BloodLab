
@php
    $breadcrumb = getContent('breadcrumb.content', true);
@endphp
<section class="inner-hero bg_img overlay--one" style="background-image: url('{{getImage('assets/images/frontend/breadcrumb/'. @$breadcrumb->data_values->background_image, '1920x1440')}}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="page-title text-white">{{__($pageTitle)}}</h2>
                <ul class="page-breadcrumb justify-content-center">
                    <li><a href="{{route('home')}}">@lang('Home')</a></li>
                    <li>{{__($pageTitle)}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
