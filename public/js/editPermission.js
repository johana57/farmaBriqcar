//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
////developed by: Johana Rivas
////e-mail: johanarivas57@gmail.com
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
$(".btn-reddit").click(function(){
    var id = $(this).val();
    var url ='permission/edit';
    $.get(url + '/' + id, function (data) {
        $('#namePermission').val(data['name']);
        $('#updatePermission').attr('action', 'updatePermission/'+id);
    })
});