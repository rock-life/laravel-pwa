(function($) {
    $('#type-header').change( function (){
        $.ajax({
            type: "GET",
            url: '/variant',
            data: {
                'id': $('#idSong').val(),
                'type': $('#type-header').find(":selected").attr('value')
            },
        }).done(function (data) {
            var buttons = '';
            $.each(data, function(index, item) {
                index++;
                buttons += '<option value="'+item +'">Варіант - '+ index +'</option>'
            })
            if (buttons == '') {
                $('#variant').attr('hidden', true);
            } else {
                $('#variant').attr('hidden', false);
                $('#variant').html(buttons);
                $('#variant').change();
            }
        }).fail(function (e){
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
            $('#text-song').html(data['text']);
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

    $('#ton+').click(function (){
        if($('#type').find(":selected").attr('type') == 1 ){

        }else if($('#type').find(":selected").attr('type') == 2){

        } else {
            var temp = $('#text-song').html();

        }
    })
    $('#ton-').click(function (){
        if($('#type').find(":selected").attr('type') == 1 ){

        }else if($('#type').find(":selected").attr('type') == 2){

        } else {

        }
    })


})(jQuery);
