@extends('layout.header')

@section('content')
    <input type="hidden" id="idSong" value="{{$idSong}}">
    <input type="hidden" id="idSongVariant" value="{{$songDetail['id']}}">
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
            <span>
                <a href="#">{{$artist}}</a>
                -
                <a>{{$name}} </a>
            </span>
                <div>
                    <select id="variant" name="variant">
                        @if(!is_array($OthersVariant))
                            {{$OthersVariant}}
                            {!! '<option value="' . $OthersVariant . '">Варіант - ' . 1 . '</option>' !!}
                        @else
                            @foreach($OthersVariant as $key => $variant)
                                @if($variant['visibility'] == false && \Illuminate\Support\Facades\Auth::id() == $variant['id_user'] || $variant['visibility'] == true)
                                    {{$key +=1}}
                                    @if($variant['id'] == $songDetail['id'])
                                        {!! '<option selected value="' . $variant['id'] . '">Варіант - ' . $key . '</option>' !!}
                                    @else
                                        {!! '<option value="' . $variant['id'] . '">Варіант - ' . $key . '</option>' !!}
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <select required name="type" id="type-header" class="" >
                        @foreach($types as $type)
                            @if($type->id == $songDetail['id_form_of_writing'])
                                {!! '<option selected value="' . $type->id . '">' . $type->name . '</option>'!!}
                            @else
                                {!! '<option type="' . $type->value . '" value="' . $type->id . '">' . $type->name . '</option>'!!}
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="song-show">
                <div class="add-song-field">
                    <pre id="text-song">{{$text}}</pre>
                </div>
                <div class="add-song-detail">
                <div class="inputs">
                    <div class="panel-action">
                        <div id="action-ton" class="components-action">
                            <input type="button" id="ton-" value="-">
                            <span>Тональність</span>
                            <input type="button" id="ton" value="+">
                        </div>
                        <div class="components-action">
                            <input type="button"  id="font-" value="-">
                            <span>Шрифт</span>
                            <input type="button"  id="font+" value="+">
                        </div>
                        <div class="components-action">
                            <input type="button"  id="scroll-" value="-">
                            <span>Прокрутити</span>
                            <input type="button"  id="scroll+" value="+">
                        </div>
                    </div>
                    @if($songDetail['video_of_song'] != null)
                        <div id="video_of_song" class="panel-iframe">
                            @if(strpos($songDetail['video_of_song'], 'iframe'))
                                {!! $songDetail['video_of_song'] !!}
                            @else
                                {!!'<input type="text" value="'. $songDetail['video_of_song'].'">' !!}
                            @endif
                            <span>Відео пісні</span>
                        </div>
                    @endif
                    @if($songDetail['video_lesson'] != null)
                        <div id="video_lesson" class="panel-iframe">
                            @if(strpos($songDetail['video_lesson'], 'iframe'))
                                {!! $songDetail['video_lesson'] !!}
                            @else
                                {!!'<input type="text" value="'. $songDetail['video_lesson'].'">' !!}
                            @endif
                                <span>Відеоурок</span>
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection()
