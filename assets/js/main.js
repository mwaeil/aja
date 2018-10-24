$(function () {


    $("#mynav .nav-item").each(function (index, element) {
        // element == this
        if ($(element).data('nav') == $("#content").data('page')) {
            $(element).addClass('active');
        }
    });

    $("#mynav .dropdown-item").each(function (index, element) {
        // element == this
        if ($(element).data('nav') == $("#content").data('subpage')) {
            $(element).addClass('active');
        }
    });





})

