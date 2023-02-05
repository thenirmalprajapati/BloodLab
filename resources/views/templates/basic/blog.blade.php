@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-4 d-md-block d-none">
               @php 
                    echo advertisements('220x474') 
                @endphp
                @php 
                    echo advertisements('220x474') 
                @endphp
                @php 
                    echo advertisements('220x474') 
                @endphp
            </div>
            <div class="col-xl-8 col-lg-9 col-md-8">
                <div class="row gy-4 justify-content-center">
                    @foreach($blogs as $blog)
                        <div class="col-lg-6">
                            <div class="blog-post">
                                <div class="blog-post__thumb">
                                    <a href="{{ route('blog.details',[$blog->id,slug($blog->data_values->title)]) }}" class="d-block"><img src="{{getImage('assets/images/frontend/blog/'. @$blog->data_values->blog_image, '728x465')}}" alt="@lang('image1')"></a>
                                </div>
                                <div class="blog-post__content">
                                    <ul class="blog-post__meta">
                                        <li>{{showDateTime($blog->created_at, 'd M Y')}}</li>
                                    </ul>
                                    <h5 class="blog-post__title mt-3"><a href="{{ route('blog.details',[$blog->id,slug($blog->data_values->title)]) }}">{{str_limit($blog->data_values->title, 70)}}</a></h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-2 d-xl-block d-none">
                @php 
                    echo advertisements('220x474') 
                @endphp
                @php 
                    echo advertisements('220x474') 
                @endphp
                @php 
                    echo advertisements('220x474') 
                @endphp
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