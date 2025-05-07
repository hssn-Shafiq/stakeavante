@php
    $counterCaption = getContent('counter.content', true);
    $counters = getContent('counter.element');
@endphp
 <!-- 
    ===============================================
                   cOUNTER SECTION
    ===============================================
    -->
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="row">
              <div class="col-md-6">
                <div class="counter-heading">
                 {{__(@$counterCaption->data_values->heading)}}
                </div>
                <p class="counter-description text-white">{{ __(@$counterCaption->data_values->description)}}</p>
              </div>
              <div class="col-md-6">
                <ul class="counter-values list-unstyled">
                 @foreach($counters as $counter)
                  <li class="border-bottom py-5">
                    <div class="value">
                      <span class="count">{{__(@$counter->data_values->counter_digit) }}</span>
                    </div>
                    <div class="description">{{__(@$counter->data_values->title)}}</div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <!-- 
    ===============================================
                  COUNTER SECTION ENDS
    ===============================================
    -->
