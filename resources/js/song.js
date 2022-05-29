(function($) {

    $('#next-songs').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) + 1;

        if (page > 0)
        $.ajax({
            type: "GET",
            url: '/next-page',
            data: {
                'page': page
            },
        }).done(function (data) {
            if(data.length > 0) {
                $('#next-page').attr('page', page);
                var text = '<tr><td>Виконавець</td><td width="50%">Пісня</td></tr>';
                for(var i = 0; data.length>i; i++){
                    var song = data[i];
                    text +=' <tr>\n' +
                        '                <td><a href="/song-artist/'+ song.id_artist +'">' + song.artist + '</a></td>\n' +
                        '                <td width="50%" ><a href="/get_song/'+ song.id +'">' + song.name + '</a></td>\n' +
                        '            </tr>';
                    $('#songs-list').html(text);
                }
                if (data.length=0)
                    $('#next-page').attr('page', page-1);
            }
        }).fail(function (e){
          console.log(e);
        });
    })
    $('#pre-songs').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) - 1;

        if (page <= 0)
            page = 0;
            $.ajax({
                type: "GET",
                url: '/next-page',
                data: {
                    'page': page
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '<tr><td>Виконавець</td><td width="50%">Пісня</td></tr>';
                    for(var i = 0; data.length>i; i++){
                        var song = data[i];
                        text +=' <tr>\n' +
                            '                <td><a href="/song-artist/'+ song.id_artist +'">' + song.artist + '</a></td>\n' +
                            '                <td width="50%" ><a href="/get_song/'+ song.id +'">' + song.name + '</a></td>\n' +
                            '            </tr>';
                        $('#songs-list').html(text);
                    }
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })

    $('#next-songsC').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) + 1;

        if (page > 0)
            $.ajax({
                type: "GET",
                url: '/categoryAS',
                data: {
                    'page': page,
                    'id':$('#categ').attr('value')
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '<tr>\n' +
                        '                        <td>Виконавець</td>\n' +
                        '                        <td width="50%">Пісня</td>\n' +
                        '                        <td></td>\n' +
                        '                    </tr>';
                    for(var i = 0; data.length>i; i++){
                        var song = data[i];
                        text +=' <tr>' +
                            '       <td><a href="/song-artist/'+ song['artistId'] +'">'+song['artistName']+'</a></td>\n' +
    '                               <td width="50%" ><a href="/get_song/'+ song['id']+'?id_song_variant='+ song['variantId'] +'&type='+song['id_form_of_writing']+'}">'+song['name']+'</a></td>\n' +
                            '       <td ><a >'+song['name_form_of_writing']+'</a></td></tr>';
                        $('#songs-list').html(text);
                    }
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })
    $('#pre-songsC').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) - 1;

        if (page <= 0)
            page = 0;
        $.ajax({
            type: "GET",
            url: '/categoryAS',
            data: {
                'page': page,
                'id':$('#categ').attr('value')
            },
        }).done(function (data) {
            if(data.length > 0) {
                $('#next-page').attr('page', page);
                var text = '<tr>\n' +
                    '                        <td>Виконавець</td>\n' +
                    '                        <td width="50%">Пісня</td>\n' +
                    '                        <td></td>\n' +
                    '                    </tr>';
                for(var i = 0; data.length>i; i++){
                    var song = data[i];
                    text +=' <tr>' +
                        '       <td><a href="/song-artist/'+ song['artistId'] +'">'+song['artistName']+'</a></td>\n' +
                        '                               <td width="50%" ><a href="/get_song/'+ song['id']+'?id_song_variant='+ song['variantId'] +'&type='+song['id_form_of_writing']+'}">'+song['name']+'</a></td>\n' +
                        '       <td ><a >'+song['name_form_of_writing']+'</a></td></tr>';
                    $('#songs-list').html(text);
                }
                if (data.length=0)
                    $('#next-page').attr('page', page-1);
            }
        }).fail(function (e){
            console.log(e);
        });
    })

    $('#type-header').change( function (){
        $.ajax({
            type: "GET",
            url: '/variant',
            data: {
                'id': $('#idSong').val(),
                'type': $('#type-header').find(":selected").attr('value')
            },
        }).done(function (data) {
            $('#saved').attr('hidden', true);
            if ($('#type-header').find(":selected").attr('value') == 2) {
                $('#action-ton').attr('hidden', true);
            }
            else {
                $('#action-ton').attr('hidden', false);
            }
            var buttons = '';
            $.each(data, function(index, item) {
                index++;
                buttons += '<option value="'+item +'">Варіант - '+ index +'</option>'
            })
            if (buttons == '') {
                $('#variant').attr('hidden', true);
                $('#song-show').attr('hidden', false);
                $('#delete_open').attr('hidden', true);
                $('#edit_open').attr('hidden', true);
                $('.song-show').attr('hidden', true);
            } else {
                $('#variant').attr('hidden', false);
                $('#variant').html(buttons);
                $('#variant').change();
                $('#delete_open').attr('hidden', false);
                $('.song-show').attr('hidden', false);
                $('#edit_open').attr('hidden', false);
                $('#song-show').attr('hidden', false);
                $('#open_song_action').attr('hidden', false);
            }
        }).fail(function (e){
            if ($('#type-header').find(":selected").attr('value') == 2) {
                $('#action-ton').attr('hidden', true);
            }
            else {
                $('#action-ton').attr('hidden', false);
            }
            $('#saved').attr('hidden', true);
            $('#delete_open').attr('hidden', true);
            $('#edit_open').attr('hidden', true);
            $('.song-show').attr('hidden', true);
            $('#variant').attr('hidden', true);
            console.log(e);
        });
    })

    $('#variant').change( function (){
        $.ajax({
            type: "GET",
            url: '/variant-text',
            data: {
                'id': $('#variant').find(":selected").attr('value'),
            },
        }).done(function (data) {
            $.ajax({
                type: "GET",
                url: '/can-edit',
                data: {
                    'id': $('#variant').find(":selected").attr('value'),
                },
            }).done(function (data){
                    if (data == true)
                        $('#edit_open').attr('hidden', false);
                    else
                        $('#edit_open').attr('hidden', true);
                })
            $('#text-song').html(data['text']);
            if (data['id_song']!= null)
                $('#saved').attr('checked', true);
            else
                $('#saved').attr('checked', false);
            $('#saved').attr('hidden', false);

            if (data['video_of_song']!=null){
                $('#video_of_song').attr('hidden',false);
                var tag = '';
                if (data['video_of_song'].indexOf('<iframe')>=0)
                    tag = data['video_of_song'];
                else
                    tag = '<input type="text" value="'+ data['video_of_song'] +'">'
                var html = tag+'<span>Відео пісні</span>';
                $('#video_of_song').html(html);
            } else {
                $('#video_of_song').attr('hidden',true);
            }
            if (data['video_lesson']!=null){
                $('#video_lesson').attr('hidden',false);
                var tag = '';
                if (data['video_lesson'].indexOf('<iframe')>=0)
                    tag = data['video_lesson'];
                else
                    tag = '<input type="text" value="'+ data['video_lesson'] +'">';
                var html = tag+'<span>Відео пісні</span>';
                $('#video_lesson').html(html);
            } else {
                $('#video_lesson').attr('hidden',true);
            }
        }).fail(function (e){
            console.log(e);
        });
    })

    $('#type').change( function (){
       var type = $('#type').find(":selected").attr('type');
        $('#note').attr('hidden', true);
        $('#rule-note').attr('hidden', true);
       if (type == 'tabs' || type == 'chords'){
           $('#add-type').attr('hidden', false);
           $('#add-type').val('Додати таби')
           $('#add-type').attr('type-song', 'tabs');
       } else if (type == 'notes') {
           $('#note').attr('hidden', false);
           $('#rule-note').attr('hidden', false);
           $('#add-type').attr('hidden', false);
           $('#add-type').val('Додати нотний стан')
           $('#add-type').attr('type-song', 'notes');
        } else {
           $('#add-type').attr('hidden', true);
       }
    })

    $('#add-type').click(function (){
        if ( $('#add-type').attr('type-song') == 'notes') {
            var temp = $('#text-edit-song').val();
            temp += '\n[note]\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '                                                                                                           \n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '                                                                                                           \n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '                                                                                                           \n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '                                                                                                           \n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '                                                                                                           \n' +
                '[note-end-line]\n';
            $('#text-edit-song').val(temp);
        } else {
            var temp = $('#text-edit-song').val();
            temp += '\n[tabs]\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '[tabs-end-line]\n';
            $('#text-edit-song').val(temp);
        }
    })

    $('#text-edit-song').on('input', (event) => {
        var type = $('#type').find(":selected").attr('type');
        var temp = $('#text-edit-song').val();
        if (type == 'notes') {
            var temp1 = $('#note').find(":selected").attr('value');
            var t = temp.replace(/@-/g,temp1);
            $('#text-edit-song').val(t);
            var t = temp.replace(/-@/g,temp1);
            $('#text-edit-song').val(t);
        }
    })

    $('#artist').on('input', (event) => {
        $('#artistVariant').attr('hidden', true);

        if ($('#artist').val().length > 2) {
            $.ajax({
                type: "GET",
                url: '/get_all_artist',
                data: {
                    'name': $('#artist').val()
                },
            }).done(function (data) {
                var buttons = '';

                var dat = data;
                if (!data.length) {
                    $.each(data, function(index, item) {
                        buttons += '<input type="button" id="'+ index +'" class="AV" value="' + item + '">'
                })
                    if (buttons == '') {
                        $('#artistVariant').attr('hidden', true);
                    } else {
                        $('#artistVariant').html(buttons);
                        $('#artistVariant').attr('hidden', false);
                    }
                }
            }).fail(function (error){
                $('#artistVariant').attr('hidden', true);
            });
        }
    })

    $(document).on('click', '.AV', function(){
        $('#artistId').attr('value',$(this).attr('id'));
        $('#artist').val($(this).val());

        $('#artistVariant').attr('hidden', true);
    });

    $('form').submit(function(){
        $(this).find('#').prop('disabled', true);
    });

    function otherPropertiesChord(alt,s_e,  i)
    {
        var k=i;
        if(i>s_e.length-3&&i<s_e.length)
            return false;
        if(alt==true)
            k= k+1;
        if(s_e[k+1]=='m')
        {
            if (s_e[k+2]==' '||s_e[k+2]=='\n'||s_e[k+2]=='\t')
                return true;
            if(s_e[k+2]>0&&s_e[k+2]<+9)
                return true;
            if(s_e[k+2]=='m'&&s_e[k+3]=='a'&&s_e[k+4]=='j')
                return true;

        }
        else {
            if (s_e[k+1]==' '||s_e[k+1]=='\n'||s_e[k+1]=='\t')
                return true;
            if(s_e[k+1]=='d'&&s_e[k+2]=='i'&&s_e[k+3]=='m')
                return true;
            if(s_e[k+1]=='s'&&s_e[k+2]=='u'&&s_e[k+3]=='s')
                return true;
            if(s_e[k+1] >= 0 && s_e[k+1] <= 9)
                return true;
        }
        return false;
    }


    function ifEditSong(s_e, i) {
        var is_alteration=false;
        switch (s_e[i+1])
        {
            case 'b': is_alteration=true; return otherPropertiesChord(is_alteration,s_e,i);
            case '#': is_alteration=true; return otherPropertiesChord(is_alteration,s_e,i);
            default:return otherPropertiesChord(is_alteration,s_e,i);
        }    }

    $('#ton').click(function (){
        if($('#type-header').find(":selected").attr('value') == 1 ){
            var song_exist = $('#text-song').html();
            var song = [];
            var j = 0;
            for (var i = 0; i<=song_exist.length; i++){
                if(song_exist[i] > 0 && song_exist[i] < 40){
                    if(song_exist[i+1] == '-'){
                        var v = parseInt(song_exist[i]) + 1;
                        song[j] = (v);
                        j++;
                    } else if (song_exist[i+1] >= 0 && song_exist[i+2] == '-'){
                        var v ='';
                        v = (song_exist[i]) + (song_exist[i+1])
                        song[j] = parseInt(v)+1;
                        i=i+2;
                        j++;
                        song[j] = "-";
                        j++;
                    }
                } else {
                    song[j] = song_exist[i];
                    j++;
                }
            }
            $('#text-song').html(song);

        } else if($('#type-header').find(":selected").attr('value') == 2){

        } else
        {
            var if_is = false;
            var Note=['A','B','C','D','E','F','G'];
            var song_exist = $('#text-song').html();
            var song = [];
            var j, v=0;

            for (var i = 0; i < song_exist.length; i++)
            {
                if(i>=song_exist.length-1)
                    break;
                for(j=0;j<Note.length;j++)
                {
                    if (song_exist[i] == Note[j])
                    {

                        if(i==0)
                        {
                            if_is=ifEditSong(song_exist,i);
                            break;
                        }
                        else{
                            if (song_exist[i - 1] == ' ' || song_exist[i - 1] == '\n' || song_exist[i - 1] == '\t')
                            {  if_is = ifEditSong(song_exist, i);
                                break;}
                            else {
                                if_is=false;
                                break;
                            }
                        }

                    }
                }
                if (if_is==false)
                {
                    song[v]=song_exist[i];
                }
                else
                {
                    if (song_exist[i + 1] == '#')
                    {
                        var t=Note.length;
                        if(j==Note.length-1)
                        {
                            song[v] = Note[0];
                            i++;
                        }
                        else
                        {song[v] = Note[j+1];
                            i++;}
                    }
                    else if(song_exist[i]=='E')
                    {
                        song[v]='F';
                    }
                    else if(song_exist[i]=='B')
                    {
                        song[v]='C';
                    }
                    else {
                        if (song_exist[i + 1] == 'b')
                        {
                            song[v] = song_exist[i];
                            i++;

                        }

                        else
                        {
                            song[v]=song_exist[i];
                            v++;
                            song[v]='#';
                        }
                    }
                    if_is=false;
                }
                v++;
            }
            song[song.length]=song_exist[song_exist.length-1];
            $('#text-song').html(song);
        }

    })
    $('#ton-').click(function (){
        var f = $('#type-header').find(":selected").attr('value');
        if($('#type-header').find(":selected").attr('value') == 1 ){
            var song_exist = $('#text-song').html();
            var song = [];
            var j = 0;
            for (var i = 0; i<=song_exist.length; i++){
                if (song_exist[i] == 1 && song_exist[i+1]=='-' && song_exist[i-1]=='-')
                {
                     var song = $('#text-song').html();
                    break;
                }
                if(song_exist[i] > 0 && song_exist[i] < 40){
                    if(song_exist[i+1] == '-'){
                        var v = parseInt(song_exist[i]) - 1;
                        song[j] = (v);
                        j++;
                    } else if (song_exist[i+1] >= 0 && song_exist[i+2] == '-'){
                        var v ='';
                        v = (song_exist[i]) + (song_exist[i+1])
                        song[j] = parseInt(v)-1;
                        j++;
                        i=i+2;
                        song[j]='-';
                        j++;
                    }
                }else {
                    song[j] = song_exist[i];
                    j++;
                }
            }
            $('#text-song').html(song);

        }else if($('#type-header').find(":selected").attr('value') == 2){

        } else
        {
            var if_is = false;
            var Note=['A','B','C','D','E','F','G'];
            var song_exist = $('#text-song').html();
            var song = [];
            var j, v=0;

            for (var i = 0; i < song_exist.length; i++)
            {
                if(i>=song_exist.length-1)
                    break;
                for(j=0;j<Note.length;j++)
                {
                    if (song_exist[i] == Note[j])
                    {

                        if(i==0)
                        {
                            if_is=ifEditSong(song_exist,i);
                            break;
                        }
                        else{
                            if (song_exist[i - 1] == ' ' || song_exist[i - 1] == '\n' || song_exist[i - 1] == '\t')
                            {  if_is = ifEditSong(song_exist, i);
                                break;}
                            else {
                                if_is=false;
                                break;
                            }
                        }

                    }
                }
                if (if_is==false)
                {
                    song[v]=song_exist[i];
                }
                else
                {
                    if (song_exist[i + 1] == '#') {
                        song[v] = song_exist[i];
                        i++;
                    }
                    else if (song_exist[i] == 'F') {
                        song[v] = 'E';
                    } else if (song_exist[i] == 'C') {
                        song[v] = 'B';
                    } else {
                        if (song_exist[i + 1] == 'b') {
                            if(j==0)
                            {
                                song[v] = Note[Note.length-1];
                                i++;
                            }
                            else {
                                song[v] = Note[j - 1];
                                i++;
                            }
                        }
                        else {
                            song[v] = song_exist[i];
                            v++;
                            song[v] = 'b';
                        }
                    }
                    if_is=false;
                }
                v++;
            }
            song[song.length]=song_exist[song_exist.length-1];
            $('#text-song').html(song);
        }
    })

    $('#font').click(function (){
        var size = $('#text-song').css('font-size');
        size.replace('px', '');
        var size = parseInt(size) + 1;
        $('#text-song').css('font-size', String(size) + 'px');
    })
    $('#font-').click(function (){
        var size = $('#text-song').css('font-size');
        size.replace('px', '');
        var size = parseInt(size)-1;
        $('#text-song').css('font-size', String(size) + 'px');
    })

    var speed = 0;

    $('#scroll').click(function (){
        var temp = $('#speed').attr('value');
        var speed1 = parseInt(temp) + 1;
        $('#speed').attr('value', speed1);
        $('#pr').html('Прокрутити - ' + String(speed1));
        speed = speed1;
    })
    $('#scroll-').click(function (){
        var temp = $('#speed').attr('value');
        var speed1 = parseInt(temp) - 1;
        if (speed1 >=0 ) {
            $('#speed').attr('value', speed1);
            $('#pr').html('Прокрутити - ' + String(speed1));
            speed = speed1;
            scrolling(speed)
        }
    })

    setInterval(function (){
        var y = $(window).scrollTop();
        $(window).scrollTop(y+speed);
    }, 1000, [speed]);

    $('#pre-page-manage').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) - 1;

        if (page <= 0)
            page = 0;
            $.ajax({
                type: "GET",
                url: '/my-added-song-ajax',
                data: {
                    'page': page
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '<tr><td>Виконавець</td><td width="50%">Пісня</td></tr>';
                    for(var i = 0; data.length>i; i++){
                        var song = data[i];
                        text +=' <tr>\n' +
                            '                <td><a href="/song-artist/'+ song.artistId +'">' + song.nameArtist + '</a></td>\n' +
                            '                <td width="50%" ><a href="/get_song/'+ song.Id +'">' + song.name + '</a></td>\n' +
                            '               <td width="10%"><input type="button" className="form-control footer-action-button" id="delete" id_song="'+song.song_variantId+'" value="Видалити"/></td>' +
                            '                <td width="10%"><a href="edit-song-page/' + song.song_variantId + '" class="form-control footer-action-button" id_song="' + song.song_variantId + '"> Редагувати </a></td>' +
                            '            </tr>';
                        $('#songs-list').html(text);
                    }
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })

    $('#next-page-manage').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) + 1;

        if (page > 0)
            $.ajax({
                type: "GET",
                url: '/my-added-song-ajax',
                data: {
                    'page': page
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '<tr><td>Виконавець</td><td width="50%">Пісня</td></tr>';
                    for(var i = 0; data.length>i; i++){
                        var song = data[i];
                        text +=' <tr>\n' +
                        '                <td><a href="/song-artist/'+ song.artistId +'">' + song.nameArtist + '</a></td>\n' +
                        '                <td width="50%" ><a href="/show-song/'+song.id +'/'+ song.song_variantId +'/'+ song.form_of_writingId +'">' + song.name + '</a></td>\n' +
                        '                <td width="10%"><a href="edit-song-page/' + song.song_variantId + '" class="form-control footer-action-button" id_song="' + song.song_variantId + '"> Редагувати </a></td>' +
                        '            </tr>';
                        $('#songs-list').html(text);
                    }
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })

    $('#delete').click(function (){
        $.ajax({
            type: "GET",
            url: '/del-my-added-song',
            data: {
                'id': $('#delete').attr('id_song')
            },
        }).done(function (data) {
            location.reload();
        }).fail(function (data){
            alert(data);
        }) ;
    })
    $('body').on('click', '.delete', function (){
        $.ajax({
            type: "GET",
            url: '/del-my-added-song',
            data: {
                'id': $(this).attr('id_song')
            },
        }).done(function (data) {
            location.reload();
        }).fail(function (data){
            alert(data);
        }) ;
    })

    $('#delete_open').click(function (){
        $.ajax({
            type: "GET",
            url: '/del-my-added-song',
            data: {
                'id': $('#variant').find(":selected").attr('value')
            },
        }).done(function (data) {
            location.href = '/songs';
        }).fail(function (data){
            alert(data);
        }) ;
    })
    $('#edit_open').click(function (){
        location.href = '/edit-song-page/' + $('#variant').find(":selected").attr('value');
    })

    $('#visibility').click(function (){
        $.ajax({
            type: "GET",
            url: '/edit-visibility',
            data: {
                'id': $('#idSongVariant').attr('value')
            },
        }).done(function (data) {
            location.reload();
        }).fail(function (data){
            alert(data);
        }) ;
    })

    $('#saved').click(function (){
        var i = $('#saved').is(":checked");
        if(i == false)
            var urls = '/del-save-song';
        else
            var urls = '/set-save-song';
        $.ajax({
            type: "GET",
            url: urls,
            data: {
                'id':$('#variant').find(":selected").attr('value'),
    },
        }).done(function (data) {
            console.log(data);
        }).fail(function (data){
            console.log(data);
        }) ;
    })

    if (location.href.indexOf('get_song') >= 0){
        $('#type-header').change();
    }
    if (location.href.indexOf('song-artist') >= 0){
        $('.footer-action-page-song').attr('hidden', true);
    }
    if (location.href.indexOf('search') >= 0){
        $('.footer-action-page-song').attr('hidden', true);
    }

    $('.role').change(function (){
        var r = $(this).find(":selected").attr('value');
        var u = $(this).find(":selected").attr('id_user');
        $.ajax({
            type: "GET",
            url: '/mod-role',
            data: {
                'role':$(this).find(":selected").attr('value'),
                'user':$(this).find(":selected").attr('id_user'),
            },
        }).done(function (data) {
            console.log(data);
        }).fail(function (data){
            console.log(data);
        }) ;
    })

    $('#pre-page-manageU').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) - 1;

        if (page <= 0)
            page = 0;
        $.ajax({
            type: "GET",
            url: '/manage-users-page',
            data: {
                'page': page
            },
        }).done(function (data) {
            if(data.length > 0) {
                $('#next-page').attr('page', page);
                var text = '<tr>\n' +
                    '                        <td>Логін</td>\n' +
                    '                        <td>Пошта</td>\n' +
                    '                        <td>Роль</td>\n' +
                    '                        <td></td>\n' +
                    '                    </tr>';
                for(var i = 0; data.length>i; i++){
                    var user = data[i];
                    if(user['roleId'] == 1){
                        var opt = '<option id_user="'+user['id']+'" value="1" selected>Користувач</option>' +
                            '<option id_user="'+user['id']+'" value="2" >Модератор</option>'
                    } else{
                        var opt = '<option id_user="'+user['id']+'" value="1">Користувач</option>' +
                            '<option id_user="'+user['id']+'" value="2" selected>Модератор</option>'
                    }
                    text +='                        <tr>\n' +
                        '                            <td><input type="hidden" id="id_user" value="'+user['id']+'"><a >'+user['login']+'</a></td>\n' +
                        '                            <td><a >'+user['email']+'</a></td>\n' +
                        '                            <td> <select class="role">\n' +
                        '                                    '+ opt +
                        '                                </select>\n' +
                        '                            </td>\n' +
                        '                        </tr> ';
                }
                $('#songs-list').html(text);

                if (data.length=0)
                    $('#next-page').attr('page', page-1);
            }
        }).fail(function (e){
            console.log(e);
        });
    })

    $('#next-page-manageU').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) + 1;

        if (page > 0)
            $.ajax({
                type: "GET",
                url: '/manage-users-page',
                data: {
                    'page': page
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '<tr>\n' +
                        '                        <td>Логін</td>\n' +
                        '                        <td>Пошта</td>\n' +
                        '                        <td>Роль</td>\n' +
                        '                        <td></td>\n' +
                        '                    </tr>';
                    for(var i = 0; data.length>i; i++){
                        var user = data[i];
                        if(user['roleId'] == 1){
                            var opt = '<option id_user="'+user['id']+'" value="1" selected>Користувач</option>' +
                            '<option id_user="'+user['id']+'" value="2" >Модератор</option>'
                        } else{
                            var opt = '<option id_user="'+user['id']+'" value="1">Користувач</option>' +
                                '<option id_user="'+user['id']+'" value="2" selected>Модератор</option>'
                        }
                        text +='                        <tr>\n' +
                            '                            <td><input type="hidden" id="id_user" value="'+user['id']+'"><a >'+user['login']+'</a></td>\n' +
                            '                            <td><a >'+user['email']+'</a></td>\n' +
                            '                            <td> <select class="role">\n' +
                            '                                    '+ opt +
                            '                                </select>\n' +
                            '                            </td>\n' +
                            '                        </tr> ';
                    }
                    $('#songs-list').html(text);
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })





    $('#pre-page-manageM').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) - 1;

        if (page <= 0)
            page = 0;
        $.ajax({
            type: "GET",
            url: '/mod-songs-page',
            data: {
                'page': page
            },
        }).done(function (data) {
            if(data.length > 0) {
                $('#next-page').attr('page', page);
                var text = '<tr>\n' +
                    '                        <td>Виконавець</td>\n' +
                    '                        <td>Пісня</td>\n' +
                    '                        <td>Опубліковано</td>\n' +
                    '                        <td></td>\n' +
                    '                        <td></td>\n' +
                    '                        <td></td>\n' +
                    '                    </tr>';
                for(var i = 0; data.length>i; i++){
                    var song = data[i];
                    if (song['visibility'])
                        var ch = 'checked'
                    else
                        var ch = '';
                    text +=' <tr>\n' +
                        '                            <td><a href="/song-artist/'+song['artistId']+'">'+song['artist']+'</a></td>\n' +
                        '                            <td ><a href="/show-song/'+ song['id']+'/'+song['variantId']+'/'+song['form_of_writingId']+'">'+song['name']+'</a></td>\n' +
                        '                                <td> <input class="visibility" value="'+song['variantId']+'" type="checkbox" '+ ch +'/> </td>\n' +
                        '                            <td> '+song['form_of_writing']+' </td>\n' +
                        '                            <td> <a href="/del-song/'+song['variantId']+'"  class="form-control footer-action-button" >Видалити</a> </td>\n' +
                        '                            <td> <a href="/edit-song-page/'+ song['variantId']+'" class="form-control footer-action-button" id_song="'+song['variantId']+'" > Редагувати </a> </td>\n' +
                        '                        </tr>';
                    $('#songs-show').html(text);
                }
                if (data.length=0)
                    $('#next-page').attr('page', page-1);
            }
        }).fail(function (e){
            console.log(e);
        });
    })

    $('#next-page-manageM').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) + 1;

        if (page > 0)
            $.ajax({
                type: "GET",
                url: '/mod-songs-page',
                data: {
                    'page': page
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '<tr>\n' +
                        '                        <td>Виконавець</td>\n' +
                        '                        <td>Пісня</td>\n' +
                        '                        <td>Опубліковано</td>\n' +
                        '                        <td></td>\n' +
                        '                        <td></td>\n' +
                        '                        <td></td>\n' +
                        '                    </tr>';
                    for(var i = 0; data.length>i; i++){
                        var song = data[i];
                        if (song['visibility'])
                            var ch = 'checked'
                        else
                            var ch = '';
                        text +=' <tr>\n' +
                            '                            <td><a href="/song-artist/'+song['artistId']+'">'+song['artist']+'</a></td>\n' +
                            '                            <td ><a href="/show-song/'+ song['id']+'/'+song['variantId']+'/'+song['form_of_writingId']+'">'+song['name']+'</a></td>\n' +
                        '                                <td> <input class="visibility" value="'+song['variantId']+'" type="checkbox" '+ ch +'/> </td>\n' +
                            '                            <td> '+song['form_of_writing']+' </td>\n' +
                            '                            <td> <a href="/del-song/'+song['variantId']+'"  class="form-control footer-action-button" >Видалити</a> </td>\n' +
                            '                            <td> <a href="/edit-song-page/'+ song['variantId']+'" class="form-control footer-action-button" id_song="'+song['variantId']+'" > Редагувати </a> </td>\n' +
                            '                        </tr>';
                        $('#songs-show').html(text);
                    }
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })

    $('body').on('click', '.visibility', function (){
        $.ajax({
            type: "GET",
            url: '/edit-visibility',
            data: {
                'id': $(this).attr('value')
            },
        }).done(function (data) {
            location.reload();
        }).fail(function (data){
            alert(data);
        }) ;
    })


    $('#pre-artist').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) - 1;
        if (page <= 0)
            page = 0;
        $.ajax({
            type: "GET",
            url: '/artists-aj',
            data: {
                'page': page
            },
        }).done(function (data) {
            if(data.length > 0) {
                $('#next-page').attr('page', page);
                var text = '';
                for(var i = 0; data.length>i; i++){
                    var song = data[i];
                    text += ' <tr>\n' +
                        '       <td><a href="/song-artist/'+song['id']+'">'+song['name']+'</a></td>\n' +
                    '         </tr>';
                    $('#songs-list').html(text);
                }
                if (data.length=0)
                    $('#next-page').attr('page', page-1);
            }
        }).fail(function (e){
            console.log(e);
        });
    })

    $('#next-artist').click(function (){
        var pages = $('#next-page').attr('page');
        var page = parseInt(pages) + 1;

        if (page > 0)
            $.ajax({
                type: "GET",
                url: '/artists-aj',
                data: {
                    'page': page
                },
            }).done(function (data) {
                if(data.length > 0) {
                    $('#next-page').attr('page', page);
                    var text = '';
                    for(var i = 0; data.length>i; i++){
                        var song = data[i];
                        text += ' <tr>\n' +
                            '       <td><a href="/song-artist/'+song['id']+'">'+song['name']+'</a></td>\n' +
                            '         </tr>';
                        $('#songs-list').html(text);
                    }
                    if (data.length=0)
                        $('#next-page').attr('page', page-1);
                }
            }).fail(function (e){
                console.log(e);
            });
    })

})(jQuery);

