$(document).ready(function() {

    //menu
    $('#menu > li').each(function(e){
        if (e == 0){
            $(this).addClass('first');
        }
        var submenu = $(this).children('ul');
        if (submenu.length == 1) {

            submenu.children('li:first').addClass('first');
            submenu.children('li:last').addClass('last');

            var submenuwidth = 0;
            submenu.children().each(function(){
                submenuwidth += $(this).outerWidth();
            });
            submenu.css('width', submenuwidth);

        }
    });

});
$(window).load(function(){

    $('#menu > li').hover(
        function(){ $(this).addClass('hover'); },
        function(){ $(this).removeClass('hover'); }
    );

});