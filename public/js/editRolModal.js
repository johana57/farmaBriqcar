$(document).on('click','.open_modal',function(){
    var id = $(this).val();
    var url ='role/edit';
    
    $.get(url + '/' + id, function (data) {
        console.log(data);
        $('#nameRol').val(data.name);
        
    })
});