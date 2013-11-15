function updateListItem() {
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post(ROOT+'projects/projectsSort',sorted+'&action=updateOrder').done(function(data) {});
}
  $(document).ready(function() {
    $('.deleteProject').on('click',function(){
        var $listaImages=$(this).parent().attr('rel');
        if(confirm('¿Estas seguro?'))
           $.post(ROOT+'ES/projects/deleteModel/'+$listaImages).done(function(data) {location.reload();});
    });
      });