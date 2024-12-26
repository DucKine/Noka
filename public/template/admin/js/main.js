$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){
    if(confirm('Se khong the khoi phuc. Ban co chac chan??')){
        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            data: { id },
            url:  url,
            success:function (result){
                if(result.error === false){
                    alert(result.message);
                    location.reload();
                }
                else{
                    alert("Xoa that bai, vui long thu lai!");
                }
            }
        })
    }
}

$('#upload').change(function(){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        data: form,
        type: 'POST',
        dataType: 'json',
        url:  '/admin/upload/services',
        success: function (results) {
            if (results.error === false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a>');

                $('#thumb').val(results.url);
            } else {
                alert('Upload File Lỗi');
            }
        }
    })
});