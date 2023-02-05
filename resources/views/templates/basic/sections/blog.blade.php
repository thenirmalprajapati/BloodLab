@php
    $blog = getContent('blog.content', true);
    $blogElements = getContent('blog.element', false, 3, true);
@endphp
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-8 col-lg-10">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__($blog->data_values->heading)}}</h2>
                    <p class="mt-2">{{__($blog->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>

        <div class="row gy-4 justify-content-center">
            @foreach($blogElements as $blogElement)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-post">
                        <div class="blog-post__thumb">
                            <a href="{{ route('blog.details',[$blogElement->id,slug($blogElement->data_values->title)]) }}" class="d-block"><img src="{{getImage('assets/images/frontend/blog/'. @$blogElement->data_values->blog_image, '728x465')}}" alt="@lang('image1')"></a>
                        </div>
                        <div class="blog-post__content">
                            <ul class="blog-post__meta">
                                <li>{{showDateTime($blogElement->created_at, 'd M Y')}}</li>
                            </ul>
                            <h5 class="blog-post__title mt-3"><a href="{{ route('blog.details',[$blogElement->id,slug($blogElement->data_values->title)]) }}">{{__($blogElement->data_values->title)}}</a></h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
