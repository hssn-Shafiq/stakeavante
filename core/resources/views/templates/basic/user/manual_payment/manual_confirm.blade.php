@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-deposit">
                <div class="card-header card-header-bg">
                    <h3>{{__($page_title)}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @php
                                $extra = $data->gateway->extra;
                            @endphp
                            <div class="col-md-12 text-center">
                                <p class="text-center mt-2">@lang('You have requested ') <b
                                        class="text--success">{{ getAmount($data['amount'])  }} {{$general->cur_text}}</b>, @lang('Please pay')
                                    <b class="text--success">{{ getAmount($data['amount'])  }} {{$general->cur_text}}</b> @lang('for successful payment')
                                </p>
                                <h4 class="text-center mb-4">@lang('Please follow the instruction bellow')</h4>
                                <p class="my-4 text-center">@php echo  $data->gateway->description @endphp</p>
                            </div>

                            @if($method->gateway_parameter)

                                @foreach(json_decode($method->gateway_parameter) as $k => $v)
                                    @if($v->type == "text")
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <input type="text" class="form-control form-control-lg"
                                                        name="{{$k}}"  value="{{old($k)}}" placeholder="{{__($v->field_level)}}">
                                            </div>
                                        </div>
                                    @elseif($v->type == "textarea")
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3">{{old($k)}}</textarea>

                                                </div>
                                            </div>
                                    @elseif($v->type == "file")
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <br>
                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                            data-trigger="fileinput">
                                                        <img class="w-h-220px"  src="{{ asset(imagePath()['image']['default']) }}" alt="@lang('gateway-image')" >
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                    <div class="img-input-div">
                                                            <span class="btn btn--info btn-file">
                                                                <span class="fileinput-new text-white"> @lang('Select') {{$v->field_level}}</span>
                                                                <span class="fileinput-exists text-white"> @lang('Change')</span>
                                                                <input type="file" name="{{$k}}" accept="image/*" >
                                                            </span>
                                                        <a href="#" class="btn btn--danger  fileinput-exists"
                                                            data-dismiss="fileinput"> @lang('Remove')</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--success   btn-block mt-2 text-center">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/address-generator.js') }}"></script>
@endpush

