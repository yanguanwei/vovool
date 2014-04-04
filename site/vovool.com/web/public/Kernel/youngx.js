var youngx = {};

youngx.responseStatus = {
    success: 1
};

youngx.ajaxConfirm = function(message, url, callback) {
    if (confirm(message)) {
        $.get(url, callback);
    }
};

youngx.parseJsonResponse = function(response) {
    if (response.status == youngx.responseStatus.success) {
        return response.body;
    }

    return false;
};