
$(function() {
   $('#sortable').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem($(ui.item).attr('rel'), $(this).attr('rel'));
        },
        tolerance: "pointer",
        connectWith: "#sortable",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    }).disableSelection();
    //var sorted = $( "#sortable" ).sortable( "serialize", { key: "sort" } );    
});
function borrarPackList($packageid){
    if(confirm('¿Estas seguro?'))
            location.href = ROOT+'/packages/delete/'+$packageid;
}
function updateListItem(itemId, newStatus) {
    //var sorted = $( "#sortable" ).sortable( "toArray" );
    var sorted = $( "#sortable" ).sortable( "serialize" );
    var package=$('#packageId').val();
    $.post(ROOT+'packages/sort',sorted+'&action=updateOrder&id='+package).done(function(data) {});
  }
  $(document).ready(function() {
    $('.addModels').on('click',function(){
         var $listaImages=$('.checkFoto:checked').serialize();
          var package=$('#packageId').val();
          $.post(ROOT+'EN/packages/addToPackage/'+package,$listaImages).done(function(data) {alert('The model has been added to package');});
    });
    $('#deleteModels').on('click',function(){
        var $lista=$('.checkFoto:checked').serialize();
        if(confirm('¿Estas seguro?'))
        $.post(ROOT+'ES/packages/deleteModels',$lista).done(function(data) {location.reload();});
    });
    
    $('.deleteSingle').on('click',function(){
        var $lista=$(this).parent().children('.checkFoto').val();
        $lista='check%5B%5D='+$lista;
        console.log($lista);
        if(confirm('¿Estas seguro?'))
        $.post(ROOT+'ES/packages/deleteModels',$lista).done(function(data) {location.reload();});
    });
    $('#deletePackage').on('click',function(){
        var $packageid=$('#packageId').val();
        if(confirm('¿Estas seguro?'))
            location.href = ROOT+'/packages/delete/'+$packageid;
    });
    $('.modelList').on('click',function(){
        var $checkbox=$(this).children('.checkFoto');
        $checkbox.prop('checked', !$checkbox.prop('checked'));
    });
    $( "#contacts" ).change(function() {
        var coma="";
        if($('#recipients').val()!="") coma=', ';
        $('#recipients').val($('#recipients').val()+coma+$(this).val());
    });
  });