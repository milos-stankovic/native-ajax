/**
 * Created by shomsy on 4/20/17.
 */
function ajax(url, method, data, headers) {
    method = method || 'GET';
    data = data || '';

    headers = headers || {};

    return new Promise(function(resolve, reject) {

        // Open a xhr request
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        // xhr.responseType = 'json';

        // set headers
        Object.keys(headers).forEach(function(key){
            xhr.setRequestHeader(key, headers[key]);
        });


        if ( method == 'POST' ) {
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // encode the data
            data = typeof data === 'string' ? data : Object.keys(data).map(function(k) {
                    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])}).join('&');
        }

        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if( xhr.status === 200 ) {
                    resolve(xhr);
                } else {
                    reject(xhr);
                }
            }
        };

        xhr.onerror = function () { reject(xhr)};

        xhr.send(data);
    });
}



