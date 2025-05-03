@php
    $about = getContent('about.content',true);
    $aboutData = getContent('about.element', false, null, true);
@endphp

<!-- About Section -->
<div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="video-section">
              <div class="thumb">
                <img src="{{ getImage('assets/images/frontend/about/'.@$about->data_values->background_image, '800x530') }}" alt="@lang('about')">
                <button
                  class="play-btn animate__animated animate__pulse animate__infinite animate__faster"
                  data-bs-toggle="modal"
                  data-bs-target="#staticBackdrop"
                >
                  <i class="fa-solid fa-play"></i>
                </button>
              </div>
              <!-- video Popup  -->

              <!-- Modal -->
              <div
                class="modal fade"
                id="staticBackdrop"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabindex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <button
                      type="button"
                      class="btn-close close-modal"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                    <div class="modal-body">
                      <iframe
                        src="{{ @$about->data_values->video_link}}"
                        title="@lang('about')"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                      ></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <!-- video Popup  -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-us-detail">
              <div class="sec-title">
                <p class="small-title text-white">{{ __(@$about->data_values->heading) }}</p>
              </div>
              <div class="about-us-prime-title">
                <h1>{{ __(@$about->data_values->subheading) }}</h1>
              </div>
              <div class="text-description">
                <p class="details-text">
                 @php echo @$about->data_values->description; @endphp
                </p>
              </div>
            </div>
            <div class="icon-grid">
              <div class="row">
                @foreach($aboutData as $data)
                <div class="col-md-6 mb-3">
                  <div class="d-flex align-items-start gap-3">
                    <div class="icon">@php echo @$data->data_values->icon; @endphp</div>
                    <div class="icon-text">
                      {{ __(@$data->data_values->paragraph) }}
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <div class="signup-btn">
              <a href="{{__(@$about->data_values->left_button_link)}}" type="button" class="btn btn-primary">{{__(@$about->data_values->left_button)}}</a>
               <a href="{{__(@$about->data_values->right_button_link)}}" type="button" class="btn btn-outline-light">
                {{__(@$about->data_values->right_button)}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- About Section -->