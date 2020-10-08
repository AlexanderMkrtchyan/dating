<?php
/* 
Template Name: Face Detection
*/
get_header();
ob_start();
//echo get_template_directory_uri();
//include(get_template_directory_uri() . '/js/models/tiny_face_detector_model-weights_manifest.json');
//include(get_template_directory_uri() . '/js/models/face_landmark_68_model-weights_manifest.json');
//include(get_template_directory_uri() . '/js/models/face_expression_model-weights_manifest.json');
//include(get_template_directory_uri() . '/js/models/face_landmark_68_model-weights_manifest.json');
//include(get_template_directory_uri() . '/js/models/face_landmark_68_tiny_model-weights_manifest.json');
//include(get_template_directory_uri() . '/js/models/face_recognition_model-weights_manifest.json');
$contents = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Face Detection API</title>
  </head>
  <body>
  <div class="face_detection">
    <video id="video" height="1080" width="1920" autoplay muted></video>


  </div>
  </body>

  <script>
    const video = document.getElementById("video");
let predictedAges = [];

Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri(get_template_directory_uri() . '/js/models/tiny_face_detector_model-weights_manifest.json'),
  faceapi.nets.faceLandmark68Net.loadFromUri("/assets/js/models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("/assets/js/models"),
  faceapi.nets.faceExpressionNet.loadFromUri("/assets/js/models"),
  faceapi.nets.ageGenderNet.loadFromUri("/assets/js/models")
]).then(startVideo);

function startVideo() {
  navigator.getUserMedia(
    { video: {} },
    stream => (video.srcObject = stream),
    err => console.error(err)
  );
}

video.addEventListener("playing", () => {
  const canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);

  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);

  setInterval(async () => {
    const detections = await faceapi
      .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
      .withFaceLandmarks()
      .withFaceExpressions()
      .withAgeAndGender();
    const resizedDetections = faceapi.resizeResults(detections, displaySize);

    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    faceapi.draw.drawDetections(canvas, resizedDetections);
    faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
    faceapi.draw.drawFaceExpressions(canvas, resizedDetections);

    const age = resizedDetections[0].age;
    const interpolatedAge = interpolateAgePredictions(age);
    const bottomRight = {
      x: resizedDetections[0].detection.box.bottomRight.x - 50,
      y: resizedDetections[0].detection.box.bottomRight.y
    };

    new faceapi.draw.DrawTextField(
      [`${faceapi.utils.round(interpolatedAge, 0)} years`],
      bottomRight
    ).draw(canvas);
  }, 100);
});

function interpolateAgePredictions(age) {
  predictedAges = [age].concat(predictedAges).slice(0, 30);
  const avgPredictedAge =
    predictedAges.reduce((total, a) => total + a) / predictedAges.length;
  return avgPredictedAge;
}

  </script>
</html>
