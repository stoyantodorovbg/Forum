$(document).ready(function(){
    $('.saveAndExit').click( function () {
        let url = $('.saveAndExit').val();
        console.log(url)
        window.location = url;
    });
});

