var ROOT = '/intranet/';
window.onload = function() {
    tinyMCE.init({
        mode: "specific_textareas",
        editor_selector: "wysiwyg",
        theme: "modern",
        menubar: false,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste"
        ],
        toolbar1: "code | undo redo | styleselect | underline bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ],
        relative_urls: false,
    });

    $('#sortable').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem();
        },
        tolerance: "pointer",
        connectWith: "#sortable",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    });


};
function showPop(id) {
    $('#white_full').css('display', 'block');
    $('#' + id).css('display', 'block');
}
/*
$(document).ready(function() {
    $("#modelList").change(function() {
        var coma = "";
        if ($('#name').val() != "")
            coma = ', ';
        $('#name').val($('#name').val() + coma + $(this).val());
    });


});*/
