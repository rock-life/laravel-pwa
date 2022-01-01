@extends('layout.header')

@section('content')
    <div class="container">
    <form action="{{route('registration')}}" class="row g-3"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Логін</label>
            <input type="text" class="form-control" name="login" id="inputLogin">
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="passord" id="inputPassword">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Повторіть пароль</label>
            <input type="password" class="form-control" name="repeat_password" id="inputRepeatPassword">
        </div>
        <div class="col-md-6">
            <label for="formFile" class="form-label">Аватарка (Не обов'язково)</label>
            <input class="form-control" type="file" name="user_photo" id="AvatarFile">
        </div>
        <div class="col-12">
            <button id="Button-registration" type="submit" class="btn btn-primary">Реєстрація</button>
        </div>
    </form>
    </div>
@endsection()
