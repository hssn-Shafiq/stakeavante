@php
    $works = getContent('why_we_are.element', false, null, true);
    $workCaption = getContent('why_we_are.content',true);
@endphp
@if($works)
 <!-- 
    ===============================================
                   WHY WE ARE SECTION
    ===============================================
    -->
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="card-intro">
              <div class="heading">
                <h1>{{__(@$workCaption->data_values->heading)}}</h1>
              </div>
            </div>
          </div>
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="row g-3">
            @foreach($works as $k => $data)
              <div class="col-md-6">
                <div class="custom-card">
                  <div class="card-img">
                    <img src="{{getImage('assets/images/frontend/why_we_are/' . @$data->data_values->feature_image, '400x400')}}" width="200"
                      height="auto" alt="@lang('step'.$k++)">
                  </div>
                  <div class="card-heading">
                    <h4>{{__(@$data->data_values->title)}}</h4>
                  </div>
                  <div class="card-desc">
                    <p>
                     {{__(@$data->data_values->description)}}
                    </p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- 
    ===============================================
                   WHY WE ARE SECTION ENDS
    ===============================================
    -->
@endif

