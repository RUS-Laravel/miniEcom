@extends('admin.layouts.app')
@section('title', __('Categories Multi'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <button type="button" data-toggle="modal" data-target="#con-close-modal" class="btn btn-outline-success waves-effect waves-light">+ New Category</button>
                <p class="sub-header font-13">
                    
                </p>

                <div class="table-responsive" data-control="category-data-table"></div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-left" id="nestable_list_menu">
                            <button type="button" class="btn btn-blue btn-sm waves-effect mb-3 waves-light" data-action="expand-all">Expand All</button>
                            <button type="button" class="btn btn-pink btn-sm waves-effect mb-3 waves-light" data-action="collapse-all">Collapse All</button>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-12">
                        <h4 class="header-title">Category List</h4>
                        <p class="sub-header font-13">
                            
                        </p>

                        <div class="custom-dd dd" id="nestable_list_1">
                            <ol class="dd-list">
                                <li class="dd-item" data-id="">
                                    <div class="dd-handle">
                                        Choose a category
                                    </div>
                                </li>
                                @foreach ($data as $child)
                                <li class="dd-item" data-id="{{$child->id}}">
                                    <div class="dd-handle">
                                        {{$child->name ?? ''}}
                                    </div>
                                    @foreach ($child->categories as $c)
                                    <ol class="dd-list" data-parent="{{$c->id ?? ''}}">
                                        <li class="dd-item" data-cid="{{$c->id ?? ''}}">
                                            <div class="dd-handle">
                                                {{$c->name ?? ''}}
                                            </div>
                                        </li>
                                    </ol>
                                    @endforeach
                                </li>
                                @endforeach
                             
                            </ol>
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div>
    </div>
   
@endsection
@push('css-lib')
    <link href="{{ url('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/nestable2/jquery.nestable.min.css')}}" rel="stylesheet" />
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/nestable2/jquery.nestable.min.js')}}"></script>
    <script src="{{ url('assets/js/pages/nestable.init.js')}}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var id = $(this).data('id');
            var cid = $(this).data('cid');
            $('[data-action="expand-all"]').click(function(){
               // $('[data-parent="'+cid+'"]').slideDown("slow");
                //$(".dd-collapsed .dd-expand").css("display", "block");
             

            });

            $('[data-action="collapse-all"]').click(function(){
                $('[data-parent="'+cid+'"]').slideUp("slow");
                //$(".dd-collapsed .dd-expand").css("display", "none");
                //$('[data-id="2"]').addClass('dd-colapsed');
            });

            
        });
    </script>
@endpush
