@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="font-size: 20px" class="">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style: none">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
