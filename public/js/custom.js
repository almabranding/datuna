var URL='/Almabranding/';
var std = ({
    fontFamily: 'Din',
    color: '#7f7e82',
    fontWeight: '500',
    letterSpacing: '0.3em',
    fontSize: '13px',
});

$(window).load(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() ){
           
        }else{
        }
    });
    //$("#nav").addClass("js");
    //$("#nav").addClass("js").before('<div id="menu">☰</div>');
    //$("#menu").click(function(){
	//$("#nav").toggle();
    //});
    //$("#nav").removeAttr("style");
//    $(window).resize(function(){
//            if(window.innerWidth > 768) {
//                    $("#nav").removeAttr("style");
//            }
//    });
});
function loadCufon() {
    Cufon.replace('p,span,label', std);
    Cufon.replace('h2', h2);
    Cufon.replace('h3', h3);
    Cufon.replace('.menuLink', menuLink);
    Cufon.replace('.menu', menu);
    Cufon.replace('.link', link);
}
