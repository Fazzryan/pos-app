function ajax_GET(url_nya, callBack) {
    $.ajax({
        type: "GET",
        url: url_nya,
        dataType: 'JSON',
        success: function (data) {

            var result = JSON.parse(JSON.stringify(data));
            var status = result.status;
            var msg = result.message;
            callBack(result);

        },
        error: function () {
            console.log(data);
        }
    });
}

function ajax_POST(url, values, callBack) {
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'JSON',
        data: values,
        success: function (data) {

            var result = JSON.parse(JSON.stringify(data));
            var status = result.status;
            var msg = result.message;
            callBack(result);

        },
        error: function () {
            console.log(data);
        }
    });
}