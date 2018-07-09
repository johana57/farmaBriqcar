$('[data-toggle="confirmation"]').confirmation();

$('[data-btn-ok-label="Si"]').click(function(){
    var id = $(this).val();
    var url ='role/delete';
     $.get(url + '/' + id, function (data) {
         console.log(data);
    })
});