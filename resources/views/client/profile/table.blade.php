<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">About me</h4>
                
                <div class="track-order-list">
                    <ul class="list-unstyled">
                        <li class="completed">
                            <h5 class="mt-0 mb-1">Name</h5>
                            <p class="text-muted">{{$user->name}} <small class="text-muted">{{$user->created_at}} </small> </p>
                        </li>
                        <li class="completed">
                            <h5 class="mt-0 mb-1">Surname</h5>
                            <p class="text-muted">{{$user->surname}} </p>
                        </li>
                        <li>
                            <h5 class="mt-0 mb-1">Email</h5>
                            <p class="text-muted">{{$user->email}} </p>
                        </li>
                   
                    </ul>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h4 class="header-title mb-3">User Information</h4>  
        </div>
    </div>
    @foreach ($userInformations as $information)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body"> 
                <p class="mb-2"><span class="font-weight-semibold mr-2">Address:</span>{{$information->address}} </p>
                <p class="mb-2"><span class="font-weight-semibold mr-2">Phone:</span>{{$information->phone}} </p>              
            </div>
        </div>
    </div> <!-- end col -->
    @endforeach
    </div>
</div>
<!-- end row -->