const FACE_MODEL_PATH = '../../faceapi/assets/models';
let faceModelsPromise = null;
let latestSnapshotDataUrl = '';

function ensureFaceModelsLoaded() {
    if (!faceModelsPromise) {
        faceModelsPromise = Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri(FACE_MODEL_PATH),
            faceapi.nets.faceLandmark68Net.loadFromUri(FACE_MODEL_PATH),
            faceapi.nets.faceRecognitionNet.loadFromUri(FACE_MODEL_PATH)
        ]);
    }

    return faceModelsPromise;
}

function dataUrlToImage(dataUrl) {
    return new Promise(function(resolve, reject) {
        const img = new Image();
        img.onload = function() {
            resolve(img);
        };
        img.onerror = function() {
            reject(new Error('Snapshot preview could not be loaded for face analysis.'));
        };
        img.src = dataUrl;
    });
}

async function buildFaceDescriptor(dataUrl) {
    await ensureFaceModelsLoaded();

    const image = await dataUrlToImage(dataUrl);
    const detection = await faceapi
        .detectSingleFace(image, new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 }))
        .withFaceLandmarks()
        .withFaceDescriptor();

    if (!detection) {
        throw new Error('No clear face was detected in the captured image.');
    }

    return Array.from(detection.descriptor);
}

$(document).ready(function() {
    ensureFaceModelsLoaded();

    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    $('#accesscamera').on('click', function() {
        Webcam.reset();
        Webcam.on('error', function() {
            $('#photoModal').modal('hide');
            swal({
                title: 'Warning',
                text: 'Please give permission to access your webcam',
                icon: 'warning'
            });
        });
        Webcam.attach('#my_camera');
    });

    $('#takephoto').on('click', take_snapshot);

    $('#retakephoto').on('click', function() {
        $('#my_camera').addClass('d-block');
        $('#my_camera').removeClass('d-none');

        $('#results').addClass('d-none');

        $('#takephoto').addClass('d-block');
        $('#takephoto').removeClass('d-none');

        $('#retakephoto').addClass('d-none');
        $('#retakephoto').removeClass('d-block');

        $('#uploadphoto').addClass('d-none');
        $('#uploadphoto').removeClass('d-block');
    });

    $('#photoForm').on('submit', async function(e) {
        e.preventDefault();
        const $uploadButton = $('#uploadphoto');

        if (!latestSnapshotDataUrl) {
            swal({
                title: 'Warning',
                text: 'Capture a photo first before saving.',
                icon: 'warning'
            });
            return;
        }

        try {
            $uploadButton.prop('disabled', true);
            const descriptor = await buildFaceDescriptor(latestSnapshotDataUrl);
            $('#faceDescriptor').val(JSON.stringify(descriptor));
        } catch (error) {
            $uploadButton.prop('disabled', false);
            swal({
                title: 'Face not detected',
                text: error.message || 'A usable face could not be extracted from the captured photo.',
                icon: 'warning'
            });
            return;
        }

        $.ajax({
            url: 'photoUpload.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $uploadButton.prop('disabled', false);
                if(data == 'success') {
                    Webcam.reset();
                    latestSnapshotDataUrl = '';
                    $('#faceDescriptor').val('');
                    $('#photoStore').val('');

                    $('#my_camera').addClass('d-block');
                    $('#my_camera').removeClass('d-none');

                    $('#results').addClass('d-none');

                    $('#takephoto').addClass('d-block');
                    $('#takephoto').removeClass('d-none');

                    $('#retakephoto').addClass('d-none');
                    $('#retakephoto').removeClass('d-block');

                    $('#uploadphoto').addClass('d-none');
                    $('#uploadphoto').removeClass('d-block');

                    $('#photoModal').modal('hide');

                    swal({
                        title: 'Success',
                        text: 'Photo uploaded successfully',
                        icon: 'success',
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        timer: 2000
                    })
                }
                else {
                    swal({
                        title: 'Error',
                        text: 'Something went wrong',
                        icon: 'error'
                    })
                }
            },
            error: function() {
                $uploadButton.prop('disabled', false);
                swal({
                    title: 'Error',
                    text: 'Something went wrong',
                    icon: 'error'
                })
            }
        })
    })
})

function take_snapshot()
{
    //take snapshot and get image data
    Webcam.snap(function(data_uri) {
        latestSnapshotDataUrl = data_uri;
        //display result image
        $('#results').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');

        var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
        $('#photoStore').val(raw_image_data);
    });

    $('#my_camera').removeClass('d-block');
    $('#my_camera').addClass('d-none');

    $('#results').removeClass('d-none');

    $('#takephoto').removeClass('d-block');
    $('#takephoto').addClass('d-none');

    $('#retakephoto').removeClass('d-none');
    $('#retakephoto').addClass('d-block');

    $('#uploadphoto').removeClass('d-none');
    $('#uploadphoto').addClass('d-block');
}