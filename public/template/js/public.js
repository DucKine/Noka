
function loadMore() {
    const page = $('#page').val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { page },
        url: '/service/load-product',
        success: function (result) {
            console.log(result)
        }
    });
}