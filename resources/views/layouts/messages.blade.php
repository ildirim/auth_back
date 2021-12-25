@if ($errors->any())
    <div class="col-sm-12 mt-2">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
        </div>
    </div>
@endif
@if (\Session::has('success'))
    <div class="col-sm-12 mt-2">
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="col-sm-12 mt-2">
        <div class="alert alert-danger">
            {!! \Session::get('danger') !!}
        </div>
    </div>
@endif