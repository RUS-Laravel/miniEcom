@extends('admin.layouts.app')
@section('title', __('User Information'))
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">User about</h4>

                @isset($userInfor->user)
                <div class="track-order-list">
                    <ul class="list-unstyled">
                        <li class="completed">
                            <h5 class="mt-0 mb-1">User name</h5>
                            <p class="text-muted">{{$userInfor?->user?->name ?? ""}}</p>
                        </li>
                        <li class="completed">
                            <h5 class="mt-0 mb-1">User surname</h5>
                            <p class="text-muted">{{$userInfor?->user?->surname ?? ""}} </p>
                        </li>
                        <li>
                           
                            <h5 class="mt-0 mb-1">Email</h5>
                            <p class="text-muted">{{$userInfor?->user?->email ?? ""}}</p>
                        </li>
                       
                    </ul>

                </div>
                @endisset

            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    @foreach ($userInfor as $infor)
            
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">User Information</h4>
     
                <p class="mb-2"><span class="font-weight-semibold mr-2">Address:</span>{{$infor->address}}</p>
                <p class="mb-2"><span class="font-weight-semibold mr-2">Phone:</span> {{$infor->phone}}</</p>
                
            </div>
        </div>
    </div> <!-- end col -->
    @endforeach
</div>
<!-- end row -->
@endsection