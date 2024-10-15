@if ($errors->any())
    <div class="alert alert-danger alert-dismissible border-0 fade show" role="alert">
        @foreach ($errors->all() as $error)
            <span class="fw-bold d-block mt-1">
                <div class="d-flex align-items-center">
                    <iconify-icon icon="solar:info-circle-linear" width="1.2em" height="1.2em"></iconify-icon>
                    <span class="ms-1">{{ $error }}</span>
                </div>
            </span>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(\Session::has('success'))
    <div class="alert alert-success fw-bold alert-dismissible border-0 fade show" role="alert">
        {!! \Session::get('success') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(\Session::has('failed'))
    <div class="alert alert-danger fw-bold alert-dismissible border-0 fade show" role="alert">
        {!! \Session::get('failed') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
