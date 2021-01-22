// time
var date = new Date().toLocaleString();
$('#time').attr("data-date", date);
$('#time').TimeCircles();

//scrolling


$('#about_me_link').click(function() {

    $('html,body').animate({

        scrollTop:$('#about_me').offset().top

    }, 1000);

    return false;

});
