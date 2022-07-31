<div class="col-lg-12 col-md-6">

    <div class="row">
        <div class="col-6">
            <div class="card h-100" onclick="changeSideCamera()">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial bg-label-info"><i class="fa fa-camera" aria-hidden="true"></i></span>
                    </div>
                    <span class="d-block text-nowrap" id="textCam">Rear Camera</span>
                    <!-- <select id="cam-list" class="form-control">
                            <option value="environment" selected>Rear Camera</option>
                            <option value="user">Selfie Camera</option>
                        </select> -->
                    <input type="hidden" id="cam-list" value="environment">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card h-100 bg-warning text-white" id="flash-toggle">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                        <span class="avatar-initial bg-label-warning">
                            <i class="fa fa-bolt fa-lg" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span class="d-block text-nowrap"><span id="flash-state">OFF</span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <button class="btn btn-info form-control" id="start-button" onclick="startScanner()" style="display: none;">Start Scanner</button>
        <button class="btn btn-danger form-control mb-4" id="stop-button" onclick="stopScanner()" style="display: none;">Stop Scanner</button>

        <div id="video-container">
            <video id="qr-video" width="100%" height="100%" style="position: relative;" class="float-start"></video>
        </div>
    </div>

    <div class="row mt-2" style="display: none;">
        <b>Detected QR code: </b>
        <span id="cam-qr-result">None</span>
        <br>
        <b>Last detected at: </b>
        <span id="cam-qr-result-timestamp"></span>
    </div>

    <div style="display: none;">
        <select id="scan-region-highlight-style-select">
            <option value="default-style">Default style</option>
            <option value="example-style-1">Example custom style 1</option>
            <option value="example-style-2">Example custom style 2</option>
        </select>
    </div>
    <input type="hidden" id="levelStudentScan">

</div>

<script src="public/js/qr/qr-scanner.umd.min.js"></script>
<script src="public/js/qr/qr-scanner.legacy.min.js"></script>

<script type="text/javascript">
    function getPassData(baseUrl, token, data) {
        console.log('baseUrl', baseUrl);
        console.log('data', data);

        $('#levelStudentScan').val(data.levelID);

        // ####### Web Cam Scanning #######
        // delete fruits;
        const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
            onDecodeError: error => {
                camQrResult.textContent = error;
                camQrResult.style.color = 'inherit';
            },
            highlightScanRegion: true,
            highlightCodeOutline: true,
        });

        const updateFlashAvailability = () => {
            scanner.hasFlash().then(hasFlash => {
                // camHasFlash.textContent = hasFlash;
                flashToggle.style.display = hasFlash ? 'block' : 'block';
            });
        };

        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

        // for debugging
        window.scanner = scanner;

        document.getElementById('scan-region-highlight-style-select').addEventListener('change', (e) => {
            videoContainer.className = 'default-style';
            scanner._updateOverlay(); // reposition the highlight because style 2 sets position: relative
        });

        flashToggle.addEventListener('click', () => {
            scanner.toggleFlash().then(() =>
                flashState.textContent = scanner.isFlashOn() ? 'ON' : 'OFF',
                flashState.textContent = scanner.isFlashOn() ? 'ON' : 'OFF',
            );
            var currentFlashOn = scanner.isFlashOn() ? "bg-info" : "bg-warning";
            var currentFlashOff = scanner.isFlashOn() ? "bg-warning" : "bg-info";
            $("#flash-toggle").removeClass(currentFlashOff).addClass(currentFlashOn);
        });

        startScanner();
    }

    video = document.getElementById('qr-video');
    videoContainer = document.getElementById('video-container');
    camHasCamera = document.getElementById('cam-has-camera');
    camList = document.getElementById('cam-list');
    // const camHasFlash = document.getElementById('cam-has-flash');
    flashToggle = document.getElementById('flash-toggle');
    flashState = document.getElementById('flash-state');
    camQrResult = document.getElementById('cam-qr-result');
    camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');

    function changeSideCamera() {
        var currentSide = $('#cam-list').val();
        if (currentSide == 'environment') {
            camList = 'user';
            $('#cam-list').val('user');
            $('#textCam').text('Selfie Camera');
        } else {
            camList = 'environment';
            $('#cam-list').val('environment');
            $('#textCam').text('Rear Camera');
        }

        scanner.setCamera(camList).then(updateFlashAvailability);
    }

    async function setResult(label, result) {

        stopScanner();

        label.textContent = result.data;
        camQrResultTimestamp.textContent = new Date().toString();
        label.style.color = 'teal';
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
        beep();

        // call api to record
        const res = await callApi('post', "attendance/recordAttendance", {
            'stud_matric_no': result.data,
            'attendance_status': 1,
        });

        if (isSuccess(res)) {
            noti(res.status, 'Attendance record');
            getDataStudentList();
        } else {
            noti(res.status); // show error message
        }

        setTimeout(function() {
            startScanner();
        }, 200);
    }

    function startScanner() {
        // $('#start-button').hide();
        // $('#stop-button').show();
        scanner.start();
        updateFlashAvailability();
    }

    function stopScanner() {
        // $('#start-button').show();
        // $('#stop-button').hide();
        flashToggle.style.display = false ? 'block' : 'block';
        scanner.stop();
    }

    function beep() {
        var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
        snd.play();
    }
</script>