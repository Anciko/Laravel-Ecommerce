@if ($type = 'success')
    @if (Session::has($type))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ Session::get($type) }} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif

@if ($type = 'error')
    @if (Session::has($type))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ Session::get($type) }} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif
