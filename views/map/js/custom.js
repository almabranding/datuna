$(window).load(function(){  
    $('.map').each(function(){
        $(this).smoothZoom({
            initial_ZOOM : 200,
            zoom_MAX:300,
            button_SIZE:22,
            button_OPACITY:1,
            pan_BUTTONS_SHOW: 'NO',
            button_ALIGN:'bottom center',
            zoom_OUT_TO_FIT:'NO'
        });
    });
});

