@extends('layout.header')

@section('content')


    <div class="container">

        @error("login")
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <form action="{{route('register.perform')}}" class="row g-3"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Логін</label>
                <input type="text" class="form-control" name="login" id="inputLogin">

                @error('login')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail">

                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror


            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Пароль</label>
                <input type="password" class="form-control" name="password" id="inputPassword">

                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Повторіть пароль</label>
                <input type="password" class="form-control" name="repeat_password" id="inputRepeatPassword">

                @error('repeat_password')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="col-12">
                <button id="Button-registration" type="submit" class="btn btn-primary">Зареєструватися</button>
            </div>
        </form>
    </div>
@endsection()
