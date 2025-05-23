var RestClient = {
    get: function (url, callback, error_callback) {
        $.ajax({
            url: "http://localhost/carcare/backend/" + url,
            type: "GET",
            beforeSend: function (xhr) {
                console.log(Utils.get_from_localstorage("User").token);
                if (Utils.get_from_localstorage("User")) {
                    xhr.setRequestHeader(
                        "Authentication",
                        Utils.get_from_localstorage("User").token

                    );
                }
            },
            success: function (response) {
                if (callback) callback(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (error_callback) error_callback(jqXHR);
            },
        });
    },
    request: function (url, method, data, callback, error_callback) {
        $.ajax({
            url: "http://localhost/carcare/backend/" + url,
            type: method,
            data: data,
            beforeSend: function (xhr) {
                if (Utils.get_from_localstorage("User")) {
                    xhr.setRequestHeader(
                        "Authentication",
                        Utils.get_from_localstorage("User").token
                    );
                }
            },
        })
            .done(function (response, status, jqXHR) {
                if (callback) callback(response);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (error_callback) {
                    error_callback(jqXHR);
                } else {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
    },
    post: function (url, data, callback, error_callback) {
        RestClient.request(url, "POST", data, callback, error_callback);
    },
    delete: function (url, data, callback, error_callback) {
        RestClient.request(url, "DELETE", data, callback, error_callback);
    },
    put: function (url, data, callback, error_callback) {
        RestClient.request(url, "PUT", data, callback, error_callback);
    },
};