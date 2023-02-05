@php
    $faq = getContent('faq.content', true);
    $faqElements = getContent('faq.element', false);
@endphp

<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$faq->data_values->heading)}}</h2>
                    <p class="mt-3">{{__(@$faq->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="accordion custom--accordion" id="faqAccordion">
            <div class="row">
                    <div class="col-lg-6 mb-4">
                        @foreach($faqElements as $faqElement)
                        @if($loop->odd)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="h-{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                                        {{__(@$faqElement->data_values->title)}}
                                    </button>
                                </h2>
                                <div id="c-{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="h-{{ $loop->iteration }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>{{__(@$faqElement->data_values->answer)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>

                     <div class="col-lg-6 mb-4">
                        @foreach($faqElements as $faqElement)
                        @if($loop->even)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="h-{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                                        {{__(@$faqElement->data_values->title)}}
                                    </button>
                                </h2>
                                <div id="c-{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="h-{{ $loop->iteration }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>{{__(@$faqElement->data_values->answer)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</section>
