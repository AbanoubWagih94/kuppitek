@if ($errors->any())
    <div class="alert alert-danger m-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-dark h5">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif