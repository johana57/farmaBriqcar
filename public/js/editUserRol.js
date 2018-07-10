$(".open_modal").click(function(){
    var id = $(this).val();
    var url ='role/user/edit';

    $.get(url + '/' + id, function (data) {
        console.log(data);
        var roleLength = data["roles"].length;
        if(roleLength != 0){
            $("input[name='roles[]']").each( function() {
                if($(this).val() == data["roles"][0]["id"]){
                    this.checked = true;
                }
            });
        }else{
            $("input[name='roles[]']").each( function() {
                this.checked = false;
            });
        }
        $('#updateUserRol').attr('action', 'updateUserRol/'+id);
    })
});