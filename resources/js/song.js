const {forEach} = require("../../public/js/app");
(function($) {

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
            temp += '[note]\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '             |--------------------------------------------------------------------------------------------|\n' +
                    '[note-end-line]\n';
            $('#text-edit-song').val(temp);
        } else {
            var temp = $('#text-edit-song').val();
            temp += '[tabs]\n' +
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
            temp.replace('*-',$('#note').find(":selected").attr('value'));
            temp.replace('-*',$('#note').find(":selected").attr('value'));
        }
    })

})(jQuery);
