(function () {
  const MODEL_PATH = 'assets/models';
  const MATCH_THRESHOLD = 0.5;
  const REFERENCES_ENDPOINT = 'reference-faces.php';
  const REQUIRED_CONFIRMATION_FRAMES = 3;
  const FRAME_INTERVAL_MS = 350;

  const state = {
    modelsLoaded: false,
    stream: null,
    referenceFaces: [],
  };

  const video = document.getElementById('video');
  const canvas = document.getElementById('captureCanvas');
  const verifyButton = document.getElementById('verifyButton');
  const statusPanel = document.getElementById('statusPanel');
  const statusBadge = document.getElementById('statusBadge');
  const statusTitle = document.getElementById('statusTitle');
  const statusText = document.getElementById('statusText');
  const referencePreview = document.getElementById('referencePreview');
  const livePreview = document.getElementById('livePreview');
  const distanceValue = document.getElementById('distanceValue');
  const indexedCount = document.getElementById('indexedCount');

  function setStatus(kind, title, text) {
    const badgeClasses = {
      idle: 'app-badge-info',
      progress: 'app-badge-info',
      success: 'app-badge-success',
      error: 'app-badge-warn',
    };

    statusPanel.classList.remove('hidden');
    statusBadge.className = 'app-badge ' + (badgeClasses[kind] || 'app-badge-info');
    statusBadge.textContent = kind === 'progress' ? 'Processing' : kind === 'success' ? 'Matched' : kind === 'error' ? 'Not matched' : 'Ready';
    statusTitle.textContent = title;
    statusText.textContent = text;
  }

  function wait(milliseconds) {
    return new Promise(function (resolve) {
      window.setTimeout(resolve, milliseconds);
    });
  }

  async function loadModels() {
    if (state.modelsLoaded) {
      return;
    }

    setStatus('progress', 'Loading face models', 'Preparing the browser-side detector and recognizer.');

    await Promise.all([
      faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_PATH),
      faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_PATH),
      faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_PATH),
    ]);

    state.modelsLoaded = true;
    setStatus('idle', 'Models loaded', 'Face recognition models are ready.');
  }

  async function loadReferenceFaces() {
    const response = await fetch(REFERENCES_ENDPOINT, {
      credentials: 'same-origin',
      headers: {
        Accept: 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error('Reference faces could not be loaded from the server.');
    }

    const payload = await response.json();
    const references = Array.isArray(payload.references) ? payload.references : [];

    if (!references.length) {
      throw new Error('No enrolled facial records are available to search.');
    }

    const indexed = [];

    for (let index = 0; index < references.length; index += 1) {
      const reference = references[index];
      setStatus('progress', 'Indexing reference faces', `Preparing face ${index + 1} of ${references.length} for search.`);

      try {
        let descriptor = null;
        let imageSrc = `${reference.imagePath}?ts=${Date.now()}`;

        if (Array.isArray(reference.descriptor) && reference.descriptor.length > 0) {
          descriptor = new Float32Array(reference.descriptor.map(function (value) {
            return Number(value);
          }));
        }

        if (!descriptor) {
          const image = await loadImage(imageSrc);
          descriptor = await computeDescriptor(image);
          imageSrc = image.src;
        }

        indexed.push({
          ...reference,
          descriptor,
          imageSrc,
        });
      } catch (error) {
        // Skip invalid or unreadable reference images instead of aborting the full index.
      }
    }

    if (!indexed.length) {
      throw new Error('Stored face images were found, but none could be indexed for matching.');
    }

    state.referenceFaces = indexed;
    indexedCount.textContent = String(indexed.length);
    setStatus('idle', 'System ready', `${indexed.length} enrolled face records are indexed. Capture a live frame to search for the best match.`);
  }

  async function startCamera() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      throw new Error('This browser does not support camera access.');
    }

    state.stream = await navigator.mediaDevices.getUserMedia({
      video: { facingMode: 'user', width: { ideal: 640 }, height: { ideal: 480 } },
      audio: false,
    });

    video.srcObject = state.stream;
    await video.play();
  }

  function captureSnapshot() {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth || 640;
    canvas.height = video.videoHeight || 480;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    return canvas.toDataURL('image/jpeg', 0.92);
  }

  function loadImage(src) {
    return new Promise((resolve, reject) => {
      const img = new Image();
      img.crossOrigin = 'anonymous';
      img.onload = function () {
        resolve(img);
      };
      img.onerror = function () {
        reject(new Error('Stored face image could not be loaded.'));
      };
      img.src = src;
    });
  }

  async function computeDescriptor(input) {
    const detection = await faceapi
      .detectSingleFace(input, new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 }))
      .withFaceLandmarks()
      .withFaceDescriptor();

    if (!detection) {
      throw new Error('No face could be detected. Make sure the face is clear and centered.');
    }

    return detection.descriptor;
  }

  function findBestMatch(descriptor) {
    let bestMatch = null;

    state.referenceFaces.forEach(function (reference) {
      const distance = faceapi.euclideanDistance(descriptor, reference.descriptor);

      if (!bestMatch || distance < bestMatch.distance) {
        bestMatch = {
          reference,
          distance,
        };
      }
    });

    return bestMatch;
  }

  async function handleVerify() {
    if (!state.modelsLoaded) {
      setStatus('progress', 'Still loading', 'Please wait until the face models finish loading.');
      return;
    }

    if (!state.referenceFaces.length) {
      setStatus('error', 'No face index available', 'No reference faces are loaded, so the live image cannot be searched.');
      return;
    }

    verifyButton.disabled = true;
    verifyButton.classList.add('opacity-60');

    try {
      const confirmationMatches = [];
      let confirmedId = null;

      for (let frameIndex = 0; frameIndex < REQUIRED_CONFIRMATION_FRAMES; frameIndex += 1) {
        setStatus('progress', 'Searching face index', `Comparing live frame ${frameIndex + 1} of ${REQUIRED_CONFIRMATION_FRAMES} against the stored face gallery.`);

        const liveDataUrl = captureSnapshot();
        livePreview.src = liveDataUrl;

        const liveDescriptor = await computeDescriptor(await faceapi.fetchImage(liveDataUrl));
        const bestMatch = findBestMatch(liveDescriptor);

        if (!bestMatch) {
          throw new Error('No enrolled face descriptors were available for comparison.');
        }

        if (bestMatch.distance > MATCH_THRESHOLD) {
          referencePreview.src = bestMatch.reference.imageSrc;
          distanceValue.textContent = bestMatch.distance.toFixed(3);
          setStatus('error', 'Face not recognized', `No enrolled face matched closely enough. Best distance found: ${bestMatch.distance.toFixed(3)}.`);
          return;
        }

        if (confirmedId === null) {
          confirmedId = bestMatch.reference.idNumber;
        } else if (confirmedId !== bestMatch.reference.idNumber) {
          throw new Error('The captured frames matched different people. Hold the camera steady and try again.');
        }

        confirmationMatches.push(bestMatch);

        if (frameIndex < REQUIRED_CONFIRMATION_FRAMES - 1) {
          await wait(FRAME_INTERVAL_MS);
        }
      }

      const averageDistance = confirmationMatches.reduce(function (sum, match) {
        return sum + match.distance;
      }, 0) / confirmationMatches.length;
      const finalMatch = confirmationMatches[confirmationMatches.length - 1];

      referencePreview.src = finalMatch.reference.imageSrc;
      distanceValue.textContent = averageDistance.toFixed(3);
      setStatus('success', 'Face matched', `${finalMatch.reference.fullName || 'Matched person'} was confirmed across ${REQUIRED_CONFIRMATION_FRAMES} frames with average distance ${averageDistance.toFixed(3)}. Redirecting to the information page.`);
      window.location.href = `Information.php?edt=${encodeURIComponent(finalMatch.reference.idNumber)}`;
    } catch (error) {
      setStatus('error', 'Verification failed', error.message || 'The verification flow could not complete.');
    } finally {
      verifyButton.disabled = false;
      verifyButton.classList.remove('opacity-60');
    }
  }

  async function initialize() {
    try {
      await Promise.all([loadModels(), startCamera()]);
      await loadReferenceFaces();
    } catch (error) {
      setStatus('error', 'Setup failed', error.message || 'Camera or model setup failed.');
      verifyButton.disabled = true;
    }
  }

  verifyButton.addEventListener('click', handleVerify);
  window.addEventListener('beforeunload', function () {
    if (state.stream) {
      state.stream.getTracks().forEach(function (track) {
        track.stop();
      });
    }
  });

  initialize();
})();