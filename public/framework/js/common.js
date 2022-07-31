// set default code
var successStatus = [200, 201, 302];
var unauthorizedStatus = [401, 403];
var errorStatus = [404, 500, 422];

const apiStatus = {
    200: 'OK',
    201: 'Created', // POST/PUT resulted in a new resource, MUST include Location header
    202: 'Accepted', // request accepted for processing but not yet completed, might be disallowed later
    204: 'No Content', // DELETE/PUT fulfilled, MUST NOT include message-body
    301: 'Moved Permanently', // The URL of the requested resource has been changed permanently
    304: 'Not Modified', // If-Modified-Since, MUST include Date header
    400: 'Bad Request', // malformed syntax
    401: 'Unauthorized', // Indicates that the request requires user authentication information. The client MAY repeat the request with a suitable Authorization header field
    403: 'Forbidden', // unauthorized
    404: 'Not Found', // request URI does not exist
    405: 'Method Not Allowed', // HTTP method unavailable for URI, MUST include Allow header
    415: 'Unsupported Media Type', // unacceptable request payload format for resource and/or method
    426: 'Upgrade Required',
    429: 'Too Many Requests',
    451: 'Unavailable For Legal Reasons', // REDACTED
    500: 'Internal Server Error', // all other errors
    501: 'Not Implemented', // (currently) unsupported request method
    503: 'Service Unavailable' // The server is not ready to handle the request.
};

async function uploadApi(url, formID = null, idProgressBar = null, reloadFunction = null) {
    try {
        url = $('meta[name="base_url"]').attr('content') + url;
        var frm = $('#' + formID);
        const dataArr = new FormData(frm[0]);

        console.log('uploadApi Data : ', ...dataArr);

        var timeStarted = new Date().getTime();

        let axiosConfig = {
            headers: {
                "Authorization": `Bearer ${$('meta[name="csrf-token"]').attr('content')}`,
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'multipart/form-data',
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            onUploadProgress: function (progressEvent) {

                if (idProgressBar != null) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);

                    $('#' + idProgressBar).html('\
                        <div class="col-12 mt-2 progress">\
                            <div id="componentProgressBarCanthink" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>\
                        </div>\
                        <div class="col-12 mt-2 mb-4">\
                            <div id="componentProgressBarStatusCanthink"></div>\
                        </div>');

                    $('#componentProgressBarCanthink').width(percentCompleted + '%');

                    var disSize = SizeToText(progressEvent.total);
                    var progress = progressEvent.loaded / progressEvent.total;
                    var timeSpent = new Date().getTime() - timeStarted;
                    var secondsRemaining = Math.round(((timeSpent / progress) - timeSpent) / 1000);

                    // calculate seconds
                    var s = secondsRemaining % 60;
                    // add leading zero to seconds if needed
                    s = s < 10 ? "0" + s : s;

                    // calculate minutes
                    var m = Math.floor(secondsRemaining / 60) % 60;
                    // add leading zero to minutes if needed
                    m = m < 10 ? "0" + m : m;

                    // calculate hours
                    var h = Math.floor(secondsRemaining / 60 / 60);

                    var time;

                    if (h != 0) {
                        time = h + " hour " + m + " minute " + s + " second";
                    } else if (m != 0) {
                        time = m + " minute " + s + " second";
                    } else {
                        time = s + " second(s)";
                    }

                    $('#componentProgressBarStatusCanthink').html(SizeToText(progressEvent.loaded) + ' of ' + disSize + ' | ' + percentCompleted + '% uploading <br> estimated time remaining : ' + time);

                    if (percentCompleted == 100) {
                        $("#componentProgressBarCanthink").addClass("bg-success").removeClass("bg-info");
                        setTimeout(function () {
                            $('#componentProgressBarCanthink').width('0%');
                            $('#componentProgressBarStatusCanthink').empty();
                            $('#' + idProgressBar).empty();
                        }, 500);
                    } else if (percentCompleted > 0 && percentCompleted <= 40) {
                        $("#componentProgressBarCanthink").addClass("bg-danger");
                    } else if (percentCompleted > 40 && percentCompleted <= 60) {
                        $("#componentProgressBarCanthink").addClass("bg-warning").removeClass("bg-danger");
                    } else if (percentCompleted > 60 && percentCompleted <= 99) {
                        $("#componentProgressBarCanthink").addClass("bg-info").removeClass("bg-warning");
                    }
                }
            }
        };

        return axios.post(url, dataArr, axiosConfig)
            .then(function (res) {

                if (reloadFunction != null) {
                    reloadFunction();
                }

                return res;
            })
            .catch(function (error) {

                if (error.response) {

                    // Request made and server responded
                    console.log(error.response.data);
                    console.log(error.response.status);

                    if (isError(error.response.status)) {
                        noti(error.response.status, 'Something went wrong');
                    } else if (isUnauthorized(error.response.status)) {
                        noti(error.response.status, "Unauthorized: Access is denied");
                    }

                } else if (error.request) {
                    // The request was made but no response was received
                    console.log('request error : ', error.request);
                    noti(500, 'Something went wrong');
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                    noti(500, 'Something went wrong');
                }

                // throw err;
            });

    } catch (e) {

        const res = e.response;
        console.log(e);
        console.log(res.status);
        console.log(res.message);

        if (isUnauthorized(res.status)) {
            noti(res.status, "Unauthorized: Access is denied");
        } else {
            noti(res.status, 'Something went wrong');
        }
    }
}

async function submitApi(url, dataObj, formID = null, reloadFunction = null, closedModal = true) {
    const submitBtnText = $('#submitBtn').html();

    var btnSubmitIDs = $('#' + formID + ' button[type=submit]').attr("id");
    var inputSubmitIDs = $('#' + formID + ' input[type=submit]').attr("id");
    var submitIdBtn = isDef(btnSubmitIDs) ? btnSubmitIDs : isDef(inputSubmitIDs) ? inputSubmitIDs : null;

    loadingBtn(submitIdBtn, true, submitBtnText);

    if (dataObj != null) {
        url = $('meta[name="base_url"]').attr('content') + url;

        // const dataArr = new URLSearchParams();

        // $.each(dataObj, function (i, field) {
        //     required = $('input[name="' + field.name + '"]').attr('required');
        //     // if (isDef(required)) {
        //     //     console.log('field ' + field.name + ' is ' + required);
        //     // }

        //     dataArr.append(field.name, field.value);
        // });

        try {
            var frm = $('#' + formID);
            const dataArr = new FormData(frm[0]);

            console.log('submitApi Data : ', ...dataArr);

            return axios({
                    method: 'POST',
                    headers: {
                        "Authorization": `Bearer ${$('meta[name="csrf-token"]').attr('content')}`,
                        'X-Requested-With': 'XMLHttpRequest',
                        'content-type': 'application/x-www-form-urlencoded',
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: url,
                    data: dataArr
                })
                .then(result => {

                    if (isSuccess(result.status) && reloadFunction != null) {
                        reloadFunction();
                    }

                    if (formID != null) {
                        var modalID = $('#' + formID).attr('data-modal');

                        // console.log(formID);
                        // console.log(modalID);
                        // var modalID = $(".modal").filter(".show").attr('id');
                        // var modalID = $('#' + formID).parents().closest('.modal').attr('id');

                        if (closedModal) {
                            setTimeout(function () {
                                if (modalID == '#generaloffcanvas-right') {
                                    $(modalID).offcanvas('toggle');
                                } else {
                                    // $('#' + modalID).modal('hide');
                                    $(modalID).modal('hide');
                                }

                            }, 200);
                        }
                    }

                    loadingBtn(submitIdBtn, false, submitBtnText);
                    noti(result.status, 'Submit');
                    return result;
                })
                .catch(error => {
                    const res = error.response;
                    console.log('ERROR 1', res);
                    if (isError(res.status)) {
                        for (var error in res.data) {
                            noti(res.status, res.data[error]);
                            // console.log('test error', res.data[error]);
                        }
                    } else if (isUnauthorized(res.status)) {
                        noti(res.status, "Unauthorized: Access is denied");
                    }
                    loadingBtn(submitIdBtn, false);
                    throw error;
                });
        } catch (e) {
            const res = e.response;
            console.log('ERROR 2', res);
            loadingBtn(submitIdBtn, false);

            if (isUnauthorized(res.status)) {
                noti(res.status, "Unauthorized: Access is denied");
            } else {
                if (isError(res.status)) {
                    var error_count = 0;
                    for (var error in res.data.errors) {
                        if (error_count == 0) {
                            noti(res.status, res.data.errors[error][0]);
                        }
                        error_count++;
                    }
                } else {
                    noti(res.status, 'Something went wrong');
                }
                return res;
            }
        }
    } else {
        noti(400, "No data to insert!");
        loadingBtn('submitBtn', false);
    }
}

async function deleteApi(id, url, reloadFunction = null) {
    if (id != '') {
        url = $('meta[name="base_url"]').attr('content') + url;
        try {
            return axios({
                    method: 'POST',
                    headers: {
                        "Authorization": `Bearer ${$('meta[name="csrf-token"]').attr('content')}`,
                        'X-Requested-With': 'XMLHttpRequest',
                        'content-type': 'application/x-www-form-urlencoded',
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: url,
                    data: new URLSearchParams({
                        id: id,
                        // _token: $('meta[name="csrf-token"]').attr('content')
                    })
                })
                .then(result => {
                    if (isSuccess(result.status) && reloadFunction != null) {
                        reloadFunction();
                    }
                    noti(result.status, 'Remove');
                    return result;
                })
                .catch(error => {
                    if (isError(error.response.status)) {
                        noti(error.response.status);
                    } else if (isUnauthorized(error.response.status)) {
                        noti(error.response.status, "Unauthorized: Access is denied");
                    }
                    throw error;
                });
        } catch (e) {
            const res = e.response;
            if (isUnauthorized(res.status)) {
                noti(res.status, "Unauthorized: Access is denied");
            } else {
                if (isError(res.status)) {
                    var error_count = 0;
                    for (var error in res.data.errors) {
                        if (error_count == 0) {
                            noti(res.status, res.data.errors[error][0]);
                        }
                        error_count++;
                    }
                } else {
                    noti(500, 'Something went wrong');
                }
                return res;
            }
        }
    } else {
        noti(400);
    }
}

async function callApi(method = 'POST', url, dataObj = null) {
    url = $('meta[name="base_url"]').attr('content') + url;

    if (dataObj != null) {
        if (isObject(dataObj) || isArray(dataObj)) {
            dataArr = {}; // {} will create an object
            for (var key in dataObj) {
                if (dataObj.hasOwnProperty(key)) {
                    dataArr[key] = dataObj[key];
                }
            }
            dataSent = new URLSearchParams(dataArr);
        } else {
            dataSent = new URLSearchParams({
                id: dataObj
            });
        }
    } else {
        dataSent = null;
    }

    // console.log('callApi Data : ', ...dataSent);

    try {
        return axios({
                method: method,
                headers: {
                    "Authorization": `Bearer ${$('meta[name="csrf-token"]').attr('content')}`,
                    'X-Requested-With': 'XMLHttpRequest',
                    'content-type': 'application/x-www-form-urlencoded',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
                url: url,
                data: dataSent
            }).then(result => {
                return result;
            })
            .catch(error => {
                if (isError(error.response.status)) {
                    noti(error.response.status, 'Something went wrong');
                } else if (isUnauthorized(error.response.status)) {
                    noti(error.response.status, "Unauthorized: Access is denied");
                }
                throw error;
            });
    } catch (e) {
        const res = e.response;
        if (isUnauthorized(res.status)) {
            noti(res.status, "Unauthorized: Access is denied");
        } else {
            if (isError(res.status)) {
                var error_count = 0;
                for (var error in res.data.errors) {
                    if (error_count == 0) {
                        noti(500, res.data.errors[error][0]);
                    }
                    error_count++;
                }
            } else {
                noti(500, 'Something went wrong');
            }
            return res;
        }
    }
}

function noti(code = 200, text = 'Something went wrong', typeToast = 'toast') {

    var resCode = typeof code === 'number' ? code : code.status;
    var textResponse = apiStatus[code];

    var messageText = isSuccess(resCode) ? ucfirst(text) + ' successfully' : isUnauthorized(resCode) ? 'Unauthorized: Access is denied' : isError(resCode) ? text : 'Something went wrong';

    if (typeToast == 'toast') {
        cuteToast({
            type: (isSuccess(code)) ? 'success' : 'error',
            title: (isSuccess(code)) ? 'Great!' : 'Ops!',
            message: messageText,
            timer: 5000,
        });
    } else {
        cuteAlert({
            type: (isSuccess(code)) ? 'success' : 'error',
            title: (isSuccess(code)) ? 'Great!' : 'Ops!',
            message: messageText,
            closeStyle: 'circle',
        });
    }
}

function log(inp) {
    if ($('pre').length) {
        $('pre').html(inp);
    } else {
        document.body.appendChild(document.createElement('pre')).innerHTML = syntaxHighlight(inp);
    }
}

function syntaxHighlight(json) {
    if (typeof json != 'string') {
        json = JSON.stringify(json, undefined, 2);
    }
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

function ucfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function loadingBtn(id, display = false, text = "<i class='fa fa-save'></i> Save") {
    if (display) {
        $("#" + id).html('Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>');
        $("#" + id).attr('disabled', true);
    } else {
        $("#" + id).html(text);
        $("#" + id).attr('disabled', false);
    }
}

function disableBtn(id, display = true, text = null) {
    $("#" + id).attr("disabled", display);
}

function isset(variable_name) {
    if (typeof variable_name !== 'undefined') {
        return true;
    }

    return false;
}

function isSuccess(res) {
    const status = typeof res === 'number' ? res : res.status;
    return this.successStatus.includes(status);
}

function isError(res) {
    const status = typeof res === 'number' ? res : res.status;
    return this.errorStatus.includes(status);
}

function isUnauthorized(res) {
    const status = typeof res === 'number' ? res : res.status;
    return this.unauthorizedStatus.includes(status);
}

// These helpers produce better VM code in JS engines due to their
// explicitness and function inlining.
function isUndef(v) {
    return v === undefined || v === null
}

function isDef(v) {
    return v !== undefined && v !== null
}

function isTrue(v) {
    return v === true
}

function isFalse(v) {
    return v === false
}

/**
 * Check if value is primitive.
 */
function isPrimitive(value) {
    return (
        typeof value === 'string' ||
        typeof value === 'number' ||
        // $flow-disable-line
        typeof value === 'symbol' ||
        typeof value === 'boolean'
    )
}

/**
 * Quick object check - this is primarily used to tell
 * Objects from primitive values when we know the value
 * is a JSON-compliant type.
 */
function isObject(obj) {
    return obj !== null && typeof obj === 'object'
}

/**
 * Get the raw type string of a value, e.g., [object Object].
 */
var _toString = Object.prototype.toString;

function toRawType(value) {
    return _toString.call(value).slice(8, -1)
}

/**
 * Strict object type check. Only returns true
 * for plain JavaScript objects.
 */
function isPlainObject(obj) {
    return _toString.call(obj) === '[object Object]'
}

function isRegExp(v) {
    return _toString.call(v) === '[object RegExp]'
}

/**
 * Check if val is a valid array index.
 */
function isValidArrayIndex(val) {
    var n = parseFloat(String(val));
    return n >= 0 && Math.floor(n) === n && isFinite(val)
}

function isPromise(val) {
    return (
        isDef(val) &&
        typeof val.then === 'function' &&
        typeof val.catch === 'function'
    )
}

function isArray(val) {
    return Array.isArray(val) ? true : false;
}

/**
 * Convert a value to a string that is actually rendered.
 */
function toString(val) {
    return val == null ?
        '' :
        Array.isArray(val) || (isPlainObject(val) && val.toString === _toString) ?
        JSON.stringify(val, null, 2) :
        String(val)
}

/**
 * Convert an input value to a number for persistence.
 * If the conversion fails, return original string.
 */
function toNumber(val) {
    var n = parseFloat(val);
    return isNaN(n) ? val : n
}

/**
 * Remove an item from an array.
 */
function remove(arr, item) {
    if (arr.length) {
        var index = arr.indexOf(item);
        if (index > -1) {
            return arr.splice(index, 1)
        }
    }
}

/**
 * Check whether an object has the property.
 */
var hasOwnProperty = Object.prototype.hasOwnProperty;

function hasOwn(obj, key) {
    return hasOwnProperty.call(obj, key)
}

/**
 * Create a cached version of a pure function.
 */
function cached(fn) {
    var cache = Object.create(null);
    return (function cachedFn(str) {
        var hit = cache[str];
        return hit || (cache[str] = fn(str))
    })
}

/**
 * Convert an Array-like object to a real Array.
 */
function toArray(list, start) {
    start = start || 0;
    var i = list.length - start;
    var ret = new Array(i);
    while (i--) {
        ret[i] = list[i + start];
    }
    return ret
}

/**
 * Merge an Array of Objects into a single Object.
 */
function toObject(arr) {
    var res = {};
    for (var i = 0; i < arr.length; i++) {
        if (arr[i]) {
            extend(res, arr[i]);
        }
    }
    return res
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function capitalize(str) {
    return str.toLowerCase().split(' ').map(function (word) {
        return word.replace(word[0], word[0].toUpperCase());
    }).join(' ');
}

function getDataPerChunk(total) {
    var percent = (10 / 100) * total;
    return Math.round(percent);
}

function SizeToText(size) {
    var sizeContext = ["B", "KB", "MB", "GB", "TB"],
        atCont = 0;

    while (size / 1024 > 1) {
        size /= 1024;
        ++atCont;
    }

    return Math.round(size * 100) / 100 + ' ' + sizeContext[atCont];
}

function refreshPage() {
    location.reload();
}

function nodata(text = true, filesName = '4.png') {

    var fileImage = $('meta[name="base_url"]').attr('content') + 'public/framework/img/nodata/' + filesName;
    var showText = (text) ? '' : 'style="display:none"';
    var suggestion = (text) ? '' : '"display:none!important"';

    return "<div id='nodata' class='col-lg-12 mb-4 mt-2'>\
            <center>\
                <img src='" + fileImage + "' class='img-fluid mb-3' width='38%'>\
                <h3 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:15px'> \
                <strong> NO INFORMATION FOUND </strong>\
                </h3>\
                <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;font-size: 13px;" + suggestion + "'> \
                    Here are some action suggestions for you to try :- \
                </h6>\
            </center>\
            <div class='row d-flex justify-content-center w-100' " + showText + ">\
                <div class='col-lg m-1 text-left' style='max-width: 350px !important;letter-spacing :1px; font-family: Quicksand, sans-serif !important;font-size: 12px;'>\
                    1. Try the registrar function (if any).<br>\
                    2. Change your word or search selection.<br>\
                    3. Contact the system support immediately.<br>\
                </div>\
            </div>\
            </div>";
}

function isWeekend(date = new Date()) {
    return date.getDay() === 6 || date.getDay() === 0;
}

function getCurrentTime() {
    var today = new Date();
    var hh = today.getHours();

    if (hh < 10) {
        hh = '0' + hh
    }
    return hh + ":" + today.getMinutes() + ":" + today.getSeconds();
}

function getCurrentDate() {

    // Use Javascript
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    return yyyy + '-' + mm + '-' + dd;
}