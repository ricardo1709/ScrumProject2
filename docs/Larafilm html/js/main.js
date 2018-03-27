

var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
            $('.header').addClass('active');
            $(".navbar-item").addClass('opacity');
        }
    if (st == lastScrollTop){
        $('.header').removeClass('active');
        $(".navbar-item").removeClass('opacity');
    }
});

$(document).ready(function(){
    $('#totop').click(function() {
        $('html,body').animate({
        scrollTop: $(".main").offset().top},
        'slow');
    });
});

var windowWidth = $(window).width();
$(document).ready(function(){
    $("#phonebutton").click(function(){
        if($(windowWidth < 432)){
            $(".navbar").toggleClass('active');
        }
    });
});
