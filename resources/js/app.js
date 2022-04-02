require("./bootstrap");

//--------------- Toggle Nav --------------------

$(document).ready(function() {
    $('.toggle-button').click(function() {
        $('nav').toggleClass('toggle');
        $('.main').toggleClass('main-toggle');
    })
})
