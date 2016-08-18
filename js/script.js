$(document).ready(function($){
    $(window).scroll(function(e){
        if($(this).scrollTop() > 100){
            $('nav.navbar')
                .removeClass('navbar navbar-default by')
                .addClass('navbar navbar-default navbar-fixed-top');
        }else{
            $('nav.navbar')
                .removeClass('navbar navbar-default navbar-fixed-top')
                .addClass('navbar navbar-default by');
        }
        //console.log();
    });
    
    $('span.desc-to-fa').click(function(){
        if(!$('div.description-fa').hasClass('active')){
            $('div.description-en').removeClass('active');
            $('div.description-fa').addClass('active');
        }else{
            $('div.description-en').addClass('active');
            $('div.description-fa').removeClass('active');
        }
    });
    
});

//navbar navbar-default navbar-fixed-top

