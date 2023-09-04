@extends('base')
@section('title', isset($title) ? $title : 'Se connecter')
@section('content')

<h2>Se connecter</h2>
<div class="card">
    <div class="card-body">
        <form action="" method="POST" class="vstack gap-2">
            @csrf
            <div>
                <input class="form-control mt-3" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div>
                <input class="form-control mt-3" type="password" name="password" " placeholder="Password">
                @error('password')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror

            </div>

            <button class="btn btn-success mt-3" type="submit">Se connecter</button>
        </form>

    </div>

</div>
@endsection

