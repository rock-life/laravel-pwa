@extends('layout.header')

@section('content')
    <form action="{{route('editMyAddedSong')}}" method="post">
        @csrf
        <input type="hidden" name id value="id">
        <div class="container song-add-container">
            <div class="add-song-field">
                <span id="rule-note" hidden>Щоб ввести коректно ноти оберіть зі списку потрібну ноту і у полі введення поставте у потрібному місці знак - @</span>
                <div class="header-content">
                    <span>Редагувати розбір</span>
                </div>
                <div class="content">
                    <textarea required name="text-edit-song" id="text-edit-song">{{$song['text']}}</textarea>
                    @error('text-edit-song')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="add-song-detail">
                <div class="inputs">
                    <input type="text" name="artist" id="artist" class="form-control" placeholder="Виконавець">
                    @error('artist')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <input type="text" name="artistId" id="artistId" value="0" hidden>
                    <div id="artistVariant" hidden>
                    </div>
                    <input required type="text" name="name" id="name" class="form-control" placeholder="Назва пісні">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <select required name="type" id="type" class="form-control" >
                        <option value="">Тип Розбору</option>
                        @foreach($types as $type)
                            {!! '<option type="' . $type->value . '" value="' . $type->id . '">' . $type->name . '</option>'!!}
                        @endforeach
                    </select>
                    @error('type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <select required name="category" id="category" class="form-control" placeholder="Категорія">
                        <option value="">Категорія</option>
                        @foreach($categorys as $category)
                            {!!'<option value="' . $category->id . '">' . $category->name . '</option>'!!}
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <input type="text" name="url_lesson" id="url_lesson" class="form-control" placeholder="Посилання на відеоурок (Youtube)" title='Як вірно вставити відео з Youtube: {{ "\n" }}На сторінці відео натисніть "Поділитися", далі натисніть "Вставити", потім скопіюйте наступний текст яки починається словами: "<iframe". {{ "\n" }} В іншому випадку залиште посилання на відео або проігноруйте це поле, адміністратори сайту зроблять все за вас.'>
                    <input type="text" name="url_song" id="url_song" class="form-control" placeholder="Посилання на відео (Youtube)" title='Як вірно вставити відео з Youtube: {{ "\n" }}На сторінці відео натисніть "Поділитися", далі натисніть "Вставити", потім скопіюйте наступний текст яки починається словами: "<iframe".{{ "\n" }} В іншому випадку залиште посилання на відео або проігноруйте це поле, адміністратори сайту зроблять все за вас.'>
                    <input type="button" id="add-type" class="btn btn-primary form-control" value="Додати таби" hidden/>
                    <select id="note" class="form-control">
                        <option>Оберіть ноту</option>
                        <option value="♩">♩</option>
                        <option value="♪">♪</option>
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
                    <input type="submit" id="add-type" class="btn btn-primary form-control" value="Додати розбір" />
                </div>
            </div>
        </div>
    </form>


@endsection()
