
@php
    $testimonialCaption = getContent('testimonial.content',true);
    $testimonials = getContent('testimonial.element');
@endphp
@if($testimonials)
  <!--
    ===============================================
                  TESTIMONIAL SECTION
    ===============================================
    -->
     <div class="col-12">
            <div class="card-intro text-center mt-top">
              <div class="heading">
                <h1>{{ __(@$clientCaption->data_values->heading) }}</h1>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div id="testimonial-slider" class="owl-carousel owl-theme">
            @foreach($testimonials as $k => $testimonial)
              <div class="item">
                <div class="testimonial">
                  <p>
                    "{{ __(@$testimonial->data_values->description) }}"
                  </p>
                  <div class="testimonial-img">
                     <img src="{{getImage('assets/images/frontend/testimonial/' . $testimonial->data_values->logo_image, '128x128')}}" width="128"
                      height="auto" alt="@lang('logo'.$k++)">
                  </div>
                  <h4 class="user-name">
                    {{__(@$testimonial->data_values->name) }}</h4>
                  <span class="designation">{{ __(@$testimonial->data_values->title) }}</span>
                </div>
              </div>
            @endforeach
            </div>
          </div>
          <!-- 
    ===============================================
                 TESTIMONIAL SECTION ENDS
    ===============================================
    -->

@endif
