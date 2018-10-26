//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#
////developed by: Johana Rivas
////e-mail: johanarivas57@gmail.com
//#-.-#-.-#-.-#-.-#-.-#-.-#-.-#-.-#


$('[data-toggle="confirmation"]').confirmation();

$('[data-btn-ok-label="Si"]').click(function(){
    var id = $(this).val();
    var url ='role/delete';
    $.get(url + '/' + id, function (data) {
        console.log(data);
        if(data == 1){
            $("#alertDanger").attr('class', 'alert alert-danger');
        }else{
            $("#succesAlert").attr('class', 'alert alert-success');
            setTimeout("location.reload()",3000);

        }
        
    })
});