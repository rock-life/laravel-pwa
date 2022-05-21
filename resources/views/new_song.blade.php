@extends('layout.header')

@section('content')

    <div class="container song-add-container">
        <div class="add-song-field">
            <span id="rule-note" hidden>Щоб ввести коректно ноти оберіть зі списку потрібну ноту і у полі введення поставте у потрібному місці знак - * (зірочка)</span>
            <div class="header-content">
                <span>{{ $action }} розбір</span>
            </div>
            <div class="content">
                <textarea id="text-edit-song"></textarea>
            </div>
        </div>
        <div class="add-song-detail">
            <div class="inputs">
                <input type="text" name="artist" id="artist" class="form-control" placeholder="Виконавець">
                <input type="text" name="name" id="name" class="form-control" placeholder="Назва пісні">
                <select ame="type" id="type" class="form-control" >
                    <option value="">Тип Розбору</option>
                    @foreach($types as $type)
                        {!! '<option type="' . $type->value . '" value="' . $type->id . '">' . $type->name . '</option>'!!}
                    @endforeach
                </select>
                <select name="category" id="category" class="form-control" placeholder="Категорія">
                    <option>Категорія</option>
                    @foreach($categorys as $category)
                        {!!'<option value="' . $category->id . '">' . $category->name . '</option>'!!}
                    @endforeach
                </select>
                <input type="text" name="url_lesson" id="url_lesson" class="form-control" placeholder="Посилання на відеоурок (Youtube)">
                <input type="text" name="url_song" id="url_song" class="form-control" placeholder="Посилання на відео (Youtube)">
                <input type="submit" id="add-type" class="btn btn-primary form-control" value="Додати таби" hidden/>
                <select id="note" class="form-control">
                    <option>Оберіть ноту</option>
                    <option value="♩">♩</option>
                    <option value="♪">♪</option>
                    <option value="♫">♫</option>
                    <option value="♬">♬</option>
                    <option value="♭">♭</option>
                    <option value="♮">♮</option>
                    <option value="♯">♯</option>
                    <option value="𝄡">𝄡</option>
                    <option value="𝄢">𝄢</option>
                    <option value="𝄪">𝄪</option>
                    <option value="𝄫">𝄫</option>
                </select>
            </div>
            <div class="inputs inputs-down">
                <input type="button" id="add-type" class="btn btn-primary form-control" value="Попередній перегляд" />
                <input type="button" id="add-type" class="btn btn-primary form-control" value="Додати розбір" />
            </div>
        </div>
    </div>

@endsection()
