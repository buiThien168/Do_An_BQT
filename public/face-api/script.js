Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('../face-api/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('../face-api/models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('../face-api/models')
]).then(start)

