function borrarPackList($packageid){
    if(confirm('¿Estas seguro?'))
            location.href = ROOT+'/agencies/delete/'+$packageid;
}