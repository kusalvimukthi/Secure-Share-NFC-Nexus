$('#logOutSpan').on('click', function (e){
    e.preventDefault();
    let token = $('meta[name="csrf-token"]').attr('content');
    // alert('test')
    $.ajax({
        url: '/logout',
        type: 'POST',
        data: {_token: token},
        // contentType: false,
        // processData: false,
        success: function(response) {
            window.location.href = '/login';
        },
        error: function(xhr, status, error) {
        }
    });
})
