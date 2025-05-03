@php
    $faqTitle = getContent('faq.content', true);
    $faqs = getContent('faq.element');
@endphp
<div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="faq-heading text-center text-white">
              <h1 class="text-capitalize">{{ __(@$faqTitle->data_values->heading) }}</h1>
            </div>
            <div class="faq-para text-center text-white">
              <p>{{ __(@$faqTitle->data_values->description) }}</p>
            </div>
          </div>
          <!-- 
    ===============================================
                 TABS
    ===============================================
    -->
          <div class="col-12">
            <div class="tabs">
              <div class="row gx-3">
                <div class="col-md-6">
                  <div
                    class="accordion accordion-flush"
                    id="accordionFlushExample"
                  >
                  @foreach($faqs as $key => $faql)
                        @if($loop->odd)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-heading{{$key}}">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#flush-collapse{{$key}}"
                          aria-expanded="false"
                          aria-controls="flush-collapse{{$key}}"
                        >
                          <strong>{{ __(@$faql->data_values->question) }}</strong>
                        </button>
                      </h2>
                      <div
                        id="flush-collapse{{$key}}"
                        class="accordion-collapse collapse"
                        aria-labelledby="flush-heading{{$key}}"
                        data-bs-parent="#accordionFlushExample"
                      >
                        <div class="accordion-body">{!!__(@$faql->data_values->answer) !!}
                        </div>
                      </div>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
                <div class="col-md-6">
                  <div
                    class="accordion accordion-flush"
                    id="accordionFlushExample2"
                  >
                  @foreach($faqs as $key => $faql)
                    @if($loop->even)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-heading{{$key}}">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#flush-collapse{{$key}}"
                          aria-expanded="false"
                          aria-controls="flush-collapse{{$key}}"
                        >
                          <strong>{{ __(@$faql->data_values->question) }}</strong>
                        </button>
                      </h2>
                      <div
                        id="flush-collapse{{$key}}"
                        class="accordion-collapse collapse"
                        aria-labelledby="flush-heading{{$key}}"
                        data-bs-parent="#accordionFlushExample2"
                      >
                        <div class="accordion-body">{!!__(@$faql->data_values->answer) !!}
                        </div>
                      </div>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 
    ===============================================
                 TABS ENDS
    ===============================================
    -->
        </div>
      </div>
    </div>
