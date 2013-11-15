
 $(window).load(function() {
  var masorny = document.querySelector('#galleryImages');
  var $container=$('#galleryImages');
    var msnry = new Masonry(masorny, {
        // options
        columnWidth: '.msh',
        isFitWidth: false,
        itemSelector: '.msh',
        gutter: 20,
    });
    msnry.bindResize();
});
function showLight(id){
    var img=gallery[id];
    if(id<1)var prev=gallery.length-1;
    else var prev=parseInt(id)-1;
    if(id>gallery.length-2)var next=0;
    else var next=parseInt(id)+1;
    $('.arrowLeft').attr('id',prev);
    $('.arrowRight').attr('id',next);
    $.post(URL+'request/light/'+img, function(data) {
         var css = {
            'background-image' : 'url("'+data+'")',
        };
      $('.backgroundContainer').css(css);  
      $('#lightBox').show();
    });
}
function hideLight(){
    console.log('sale');
    var css = {
            'background-image' : 'url("")',
        };
      $('.backgroundContainer').css(css);  
      $('#lightBox').hide();
}