@if ($errors and count($errors))
    @foreach ($errors as $error)
        @foreach ($error as $message)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $message ?? '' }}
            </div>
        @endforeach
    @endforeach
@endif
