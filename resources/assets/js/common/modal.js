var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var modal = $('#modal');


modal.on('click', '.btn-ok', function(e) {

    var $modalDiv = $(e.delegateTarget);
    var location = $(this).data('location');
    var replace = $(this).data('replace');
    console.log(location);
    $.ajax({
        url: location,
        type: 'DELETE',
        data: {
            _token: CSRF_TOKEN,
        },
        success: function( data ) {
            $modalDiv.modal('hide').removeClass('loading');
            window.location.replace(replace);
        }

    });
});

modal.on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    if(!data.body) {
        $(this).find('.body').addClass('hidden');
    } else {
        $(this).find('.body').removeClass('hidden');
        $('.body', this).text(data.body);
    }
    $('.title', this).text(data.title);
    $('.btn-ok', this).data('location', data.location);
    $('.btn-ok', this).data('replace', data.replace);
});
