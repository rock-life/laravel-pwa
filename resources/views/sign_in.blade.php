@extends('layout.header')
@section('content')
<div class="container">
    <form method="post" action="{{route('sign_in_to_account')}}">
        @csrf
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email або логін</label>
            <div class="col-sm-10">
                <input type="text" name="login" class="form-control" id="inputEmail3">
                @error('login')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Вхід</button>
    </form>
</div>
@endsection
