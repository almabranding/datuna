$(document).ready(function() {

});
var sourceSwap = function() {
    var $this = $(this);
    var newSource = $this.data('alt-src');
    $this.data('alt-src', $this.attr('src'));
    $this.attr('src', newSource);
}
function openSection(section) {
    $("#" + section).slideDown("slow");
}
$('.closeico').on('click', function() {
    $(this).parents('.hideSection').slideUp("slow");
});
$(".preGif").hover(sourceSwap, sourceSwap);

