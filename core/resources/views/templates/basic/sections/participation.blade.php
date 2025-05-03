@php
    $participationCaption = getContent('participation.content',true);
    $participation = getContent('participation.element');
@endphp

@if($participation)
 <!-- 
    ===============================================
                 PARTICIPATION SECTION
    ===============================================
    -->
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="card-intro text-center">
              <div class="heading">
                <h1>{{ __(@$participationCaption->data_values->heading) }}</h1>
              </div>
            </div>
          </div>
          <div
            class="col-12"
            data-aos="fade-up"
            data-aos-offset="200"
            data-aos-duration="1000"
          >
            <div class="participant-links-wrap">
              <div class="row gy-5 gy-md-0">
                @foreach($participation as $k => $data)
                <div class="col-md-6">
                  <h4 class="head-text">{{__(@$data->data_values->title)}}</h4>
                  <p class="desc-para">{{__(@$data->data_values->description)}}
                  </p>
                  <a href="{{__(@$data->data_values->button_link)}}" class="btn btn-outline-light">{{__(@$data->data_values->button)}} <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          @endif
          <!-- 
    ===============================================
                 PARTICIPATION SECTION ENDS
    ===============================================
    -->