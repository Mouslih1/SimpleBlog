@extends('base')
@section('title', isset($title) ? $title : "S'inscrire")
@section('content')

<h2>S'inscrire</h2>
<div class="card">
    <div class="card-body">
        <form action="" method="POST" class="vstack gap-2">
            @csrf
            <div>
                <input class="form-control mt-3" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer un nom">
                @error('name')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div>
                <input class="form-control mt-3" type="text" name="email" value="{{ old('email') }}" placeholder="Entrer un email">
                @error('email')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div>
                <input class="form-control mt-3" type="password" name="password" " placeholder="Enter un password">
                @error('password')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div>
                <input class="form-control mt-3" type="password" name="password_confirmation" " placeholder="Enter confirmation password">
                @error('password_confirmation')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror

            </div>

            <button class="btn btn-success mt-3" type="submit">S'inscrire</button>
        </form>

    </div>

</div>
@endsection

