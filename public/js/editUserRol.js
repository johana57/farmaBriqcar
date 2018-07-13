//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
////developed by: Johana Rivas
////e-mail: johanarivas57@gmail.com
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
$(".open_modal").click(function(){
    var id = $(this).val();
    var url ='role/user/edit';
    var i = 0;
    var b = 0;
    var checksAvailable = new Array();
    $(".checkbox").attr('checked', false);
     
    $.get(url + '/' + id, function (data) {
        var checksSearchs = data['roles'];
                
        if(checksSearchs.length != 0){
            $("input[name='roles[]']").each( function(index) {
                checksAvailable[index] = {};
                checksAvailable[index]['id'] = $(this).val();
            });
           
            while(i < checksSearchs.length && b < checksAvailable.length){
                if(checksSearchs[i]['id'] != checksAvailable[b]['id'] ){
                    console.log("#rol" + checksAvailable[b]['id']);
                    b++;
                }
                else
                {
                    console.log("rol"+checksAvailable[b]['id']);
                    $("#rol" + checksAvailable[b]['id']).attr('checked', true);
                    i++;
                    b =0;
                }

            }
        }
        $('#updateUserRol').attr('action', 'updateUserRol/'+id);
    })
});