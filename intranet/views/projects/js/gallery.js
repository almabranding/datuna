function updateListItem() {
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post(ROOT+'projects/imagesSort',sorted+'&action=updateOrder').done(function(data) {});
}
  $(document).ready(function() {
      var $project_id=$('#project_id').val();
    $('.listImage').on('click',function(){
        var $checkbox=$(this).parent().children('.checkFoto');
        $checkbox.prop('checked', !$checkbox.prop('checked'));
    });
    $('.deleteSingle').on('click',function(){
        var $lista=$(this).parent().children('.checkFoto').val();
        $lista='check%5B%5D='+$lista;
        if(confirm('¿Estas seguro?'))
        $.post(ROOT+'ES/projects/deleteImages',$lista).done(function(data) {location.reload();});
    });
    $('#deleteImage').on('click',function(){
        var $listaImages=$('.checkFoto:checked').serialize();
        if(confirm('¿Estas seguro?'))
           $.post(ROOT+'ES/projects/deleteImages',$listaImages).done(function(data) {location.reload();});
    });
    $('#saveInputs').on('click',function(){
       var $listaInputs=$(':input').serialize();
       $.post(ROOT+'ES/projects/saveInputs',$listaInputs).done(function(data) {alert("Changes has been saved");});
    });
    $('#allSelect').on('click',function(){
       var $checkbox=$('.checkFoto');
       $checkbox.prop('checked', true);
    });
    $('#selectThumbnail').on('click',function(){
        $('.checkFoto:checked').index();
        var $listaImages=$('.checkFoto:checked').serialize();
        if($('.checkFoto:checked').size()>1){
            alert('Select only one picture');
            return 0;
        }
        $.post(ROOT+'ES/projects/selectThumbnail',$listaImages+'&project_id='+$project_id).done(function(data) {location.reload();});
    });
  });