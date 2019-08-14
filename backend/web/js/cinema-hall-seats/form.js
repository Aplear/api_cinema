$(document).on('change', '#cinemahallseats-cinema_hall_id', function() {
   var val = $(this).val();
   var url = $(this).data('url-seats');

    $.ajax({
        url: url,
        type: 'GET',
        data: {id : val},
        dataType: "JSON",
        async: true,
        success: function(data) {
            $('#cinemahallseats-cinema_hall_row_id').attr('disabled',false).html(data);
        }
    });
});