$(document).ready(function(){
    $('.saveAndExit').click( function () {
        let url = $('.saveAndExit').val();
        console.log(url)
        axios.get(url).then(function (response) {
            console.log(response.data);
            window.location = response.data.redirect;
        });
    })
});

