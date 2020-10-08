/*
$(document).ready(function(){
var image = document.getElementById('gif_anime');

function captureCamera(callback) {
    navigator.mediaDevices.getUserMedia({
        video: true
    }).then(function (camera) {
        callback(camera);
    }).catch(function (error) {
        alert('Unable to capture your camera. Please check console logs.');
        console.error(error);
    });
}

function stopRecordingCallback() {
    document.querySelector('h1').innerHTML = 'Gif recording stopped: ' + bytesToSize(recorder.getBlob().size);
    image.src = URL.createObjectURL(recorder.getBlob());
    recorder.camera.stop();

    var blob = recorder.getBlob();
    //console.log(blob)
    // generating a random file name
    var fileName = getFileName('gif');
    //alert('this is filename - ' + fileName)
    // we need to upload "File" --- not "Blob"
    var fileObject = new File([blob], fileName, {
        type: 'mpeg/gif'
    });
    //console.log(fileObject)






    var data = new FormData();
    // recorded data
    data.append('gif-file', fileObject);
    // file name
    data.append('gif-name', fileObject.name);
    data.append('gif-size', fileObject.size);
    data.append('gif-type', fileObject.type);
    
    data.append("ibenic_file_upload", fileObject);
    data.append('action', 'ibenic_file_upload');
    alert(fileObject)
     //var upload_url = '/wp-admin/themes/dating/inc/ajax_upload_test.php';
    // var upload_url = 'RecordRTC-to-PHP/save.php';
    // var upload_directory = 'RecordRTC-to-PHP/uploads/';
    // upload using jQuery
    $.ajax({
         url: data.ajax_url,
             type: 'POST',
             data: data,
             cache: false,
             dataType: 'json',
             processData: false, // Don't process the files
             contentType: false,
        success: function (data, textStatus, jqXHR) {

                if (data.response == "SUCCESS") {
                   alert('vax hors arev')
                 } else {
                console.log(data.error); // error/failure
            }
        }
    });

    // this function is used to generate random file name
    // this function is used to generate random file name
    function getFileName(fileExtension) {
        var d = new Date();
        var year = d.getUTCFullYear();
        var month = d.getUTCMonth();
        var date = d.getUTCDate();
        return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
    }

    function getRandomString() {
        if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
            var a = window.crypto.getRandomValues(new Uint32Array(3)),
                token = '';
            for (var i = 0, l = a.length; i < l; i++) {
                token += a[i].toString(36);
            }
            return token;
        } else {
            return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
        }
    }











    recorder.destroy();
    recorder = null;

}

var recorder; // globally accessible

document.getElementById('btn-start-recording').onclick = function () {
    this.disabled = true;
    captureCamera(function (camera) {
        document.querySelector('h1').innerHTML = 'Waiting for Gif Recorder to start...';
        recorder = RecordRTC(camera, {
            type: 'gif',
            frameRate: 1,
            quality: 10,
            width: 360,
            hidden: 240,
            onGifRecordingStarted: function () {
                document.querySelector('h1').innerHTML = 'Gif recording started.';
            },
            onGifPreview: function (gifURL) {
                image.src = gifURL;
            }
        });

        recorder.startRecording();

        // release camera on stopRecording
        recorder.camera = camera;

        document.getElementById('btn-stop-recording').disabled = false;
    });
};

document.getElementById('btn-stop-recording').onclick = function () {
    this.disabled = true;
    recorder.stopRecording(stopRecordingCallback);
};
})

*/