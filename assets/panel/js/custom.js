$('.extra-fields-customer').click(function() {
    $('.gallery_records').clone().appendTo('.gallery_records_dynamic');
    $('.gallery_records_dynamic .gallery_records').addClass('single remove');
    $('.single .extra-fields-customer').remove();
    $('.single').append('<a href="#" class="remove-field btn btn-danger btn-sm btn-remove-customer">Remove <small><i class="fa fa-minus-circle"></i></small></a>');
    $('.gallery_records_dynamic > .single').attr("class", "remove");

    $('.gallery_records_dynamic input').each(function() {
        var count = 0;
        var fieldname = $(this).attr("name");
        $(this).attr('name', fieldname + count);
        count++;
        if (fieldname == 'file000') {
            $('.extra-fields-customer').hide();
        }
    });

});

$(document).on('click', '.remove-field', function(e) {
    $(this).parent('.remove').remove();
    e.preventDefault();
});