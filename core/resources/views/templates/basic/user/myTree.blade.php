@extends($activeTemplate . 'user.layouts.app')

@push('style')
    <link href="{{asset('assets/admin/css/tree.css')}}" rel="stylesheet">
@endpush

@section('panel')
    <div class="card">
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-1">
                @php echo showSingleUserinTree($tree['a'],1); @endphp
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-4">
                @php echo showSingleUserinTree($tree['h']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4">
                @php echo showSingleUserinTree($tree['i']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4">
                @php echo showSingleUserinTree($tree['j']); @endphp
            </div>
        </div>
    </div>


    <div class="modal fade user-details-modal-area" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">@lang('User Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-details-modal">
                        <div class="user-details-header ">
                            <div class="thumb"><img src="#" alt="*" class="tree_image w-h-100-p"
                                ></div>
                            <div class="content">
                                <a class="user-name tree_url tree_name" href=""></a>
                                <span class="user-status tree_status"></span>
                                <span class="user-status tree_plan"></span><br/>
                                <span class="user-status">Total Sale:</span>
                                <span class="user-status user_sale"></span>
                                <br/>
                                <span class="user-status">Staking Plan:</span>
                                <span class="user-status user_duration"></span>
                            </div>
                        </div>
                        <div class="user-details-body text-center">

                            <h6 class="my-3">@lang('Referred By'): <span class="tree_ref"></span></h6>
<table class="table table-bordered">
                                <tr>
                                    <th>@lang('Levels')</th>
                                    <th>@lang('Required Users')</th>
                                    <th>@lang('Available  Users')</th>
                                </tr>

                                <tr>
                                    <td>@lang('Level 1')</td>
                                    <td>@lang('3')</td>
                                    <td><span class="level1"></span></td>
                                </tr>
                                <tr>
                                    <td>@lang('Level 2')</td>
                                    <td>@lang('9')</td>
                                    <td><span class="level2"></span></td>
                                </tr>

                                <tr>
                                    <td>@lang('Level 3')</td><td>@lang('27')</td>
                                    <td><span class="level3"></span></td>
                                </tr>
                                <tr>
                                    <td>@lang('Level 4')</td>
                                    <td>@lang('81')</td>
                                    <td><span class="level4"></span></td>
                                </tr>
                                <tr>
                                    <td>@lang('Level 5')</td>
                                    <td>@lang('243')</td>
                                    <td><span class="level5"></span></td>
                                </tr>
                                <tr>
                                    <td>@lang('Level 6')</td>
                                    <td>@lang('729')</td>
                                    <td><span class="level6"></span></td>
                                </tr>
                                <tr>
                                    <td>@lang('Level 7')</td>
                                    <td>@lang('2187')</td>
                                    <td><span class="level7"></span></td>
                                </tr>
                                <tr>
                                    <th>@lang('Total')</th>
                                    <td>@lang('3279')</td>
                                    <th><span class="levelall"></span></th>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('script')
    <script>
        "use strict";
        (function ($) {
            $('.showDetails').on('click', function () {
                var modal = $('#exampleModalCenter');
                $('.tree_name').text($(this).data('name'));
                $('.tree_url').attr({"href": $(this).data('treeurl')});
                $('.tree_status').text($(this).data('status'));
                $('.user_sale').text($(this).data('sale'));
                $('.user_duration').text($(this).data('duration'));
                $('.tree_plan').text($(this).data('plan'));
                $('.tree_image').attr({"src": $(this).data('image')});
                $('.user-details-header').removeClass('Paid');
                $('.user-details-header').removeClass('Free');
                $('.user-details-header').addClass($(this).data('status'));
                $('.tree_ref').text($(this).data('refby'));
                if($(this).data('level1')==null){
                $('.level1').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level1').text($(this).data('level1'));
                }
                if($(this).data('level2')==null){
                $('.level2').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level2').text($(this).data('level2'));
                }
                if($(this).data('level3')==null){
                $('.level3').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level3').text($(this).data('level3'));
                }
                if($(this).data('level4')==null){
                $('.level4').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level4').text($(this).data('level4'));
                }
                if($(this).data('level5')==null){
                $('.level5').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level5').text($(this).data('level5'));
                }
                if($(this).data('level6')==null){
                $('.level6').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level6').text($(this).data('level6'));
                }
                if($(this).data('level7')==null){
                $('.level7').html('<i class="fa fa-lock"></i>');
                }else{
                $('.level7').text($(this).data('level7'));
                }
                $('.levelall').text($(this).data('levelall'));
                $('#exampleModalCenter').modal('show');
            });
        })(jQuery);
    </script>

@endpush
@push('breadcrumb-plugins')
    <form action="{{route('user.other.tree.search')}}" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="username" class="form-control" placeholder="@lang('Search by username')">
            <div class="input-group-append">
                <button class="btn btn--success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush



