$(".open_modal").click(function(){
    var id = $(this).val();
    var url ='role/edit';
    var i = 1;
    $.get(url + '/' + id, function (data) {
//        console.log(data);
        $('#nameRol').val(data[0]['name']);
        $("input[name='permissionsEdit[]']").each( function() {
            if($(this).val() == data[i]){
                this.checked = true;
            }
            i++;
        });
        
        $('#updateRol').attr('action', 'updateRole/'+id);
    })
});