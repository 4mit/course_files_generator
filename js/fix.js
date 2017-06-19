$("document").ready(function($){
    var nav = $('#logo');

	
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            nav.addClass("f-nav");
	 
        } else {
            nav.removeClass("f-nav");
	
        }
    });
});