@php
    $clientCaption = getContent('client.content',true);
    $client = getContent('client.element');
@endphp
@if($client)
 <!-- 
    ===============================================
                 BRANDS SCROLL ANIMATION
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
            <div class="logos">
              <div class="logos-slide">
                @foreach($client as $k => $data)
                <img src="{{getImage('assets/images/frontend/client/' . @$data->data_values->client_image, '210x35')}}" width="210"
                      height="auto" alt="@lang('client'.$k++)">
                @endforeach
              </div>
            </div>
            <div class="logos-rev">
              <div class="logos-slide">
                @foreach($client as $k => $data)
                <img src="{{getImage('assets/images/frontend/client/' . @$data->data_values->client_image, '210x35')}}" width="210"
                      height="auto" alt="@lang('client'.$k++)">
                @endforeach
              </div>
            </div>
            <div class="logos">
              <div class="logos-slide">
                @foreach($client as $k => $data)
                <img src="{{getImage('assets/images/frontend/client/' . @$data->data_values->client_image, '210x35')}}" width="210"
                      height="auto" alt="@lang('client'.$k++)">
                @endforeach
              </div>
            </div>
         </div>
          <!-- 
    ===============================================
                 BRANDS SCROLL ANIMATION ENDS
    ===============================================
    -->
@endif