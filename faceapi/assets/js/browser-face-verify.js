(function () {
  const MODEL_PATH = 'assets/models';
  const MATCH_THRESHOLD = 0.5;
  const REFERENCES_ENDPOINT = 'reference-faces.php';

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
        const image = await loadImage(`${reference.imagePath}?ts=${Date.now()}`);
        const descriptor = await computeDescriptor(image);

        indexed.push({
          ...reference,
          descriptor,
          imageSrc: image.src,
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
      setStatus('progress', 'Searching face index', 'Comparing the live camera frame against all stored facial records.');

      const liveDataUrl = captureSnapshot();
      livePreview.src = liveDataUrl;

      const liveDescriptor = await computeDescriptor(await faceapi.fetchImage(liveDataUrl));
      let bestMatch = null;

      state.referenceFaces.forEach(function (reference) {
        const distance = faceapi.euclideanDistance(liveDescriptor, reference.descriptor);

        if (!bestMatch || distance < bestMatch.distance) {
          bestMatch = {
            reference,
            distance,
          };
        }
      });

      if (!bestMatch) {
        throw new Error('No enrolled face descriptors were available for comparison.');
      }

      referencePreview.src = bestMatch.reference.imageSrc;
      distanceValue.textContent = bestMatch.distance.toFixed(3);

      if (bestMatch.distance <= MATCH_THRESHOLD) {
        setStatus('success', 'Face matched', `${bestMatch.reference.fullName || 'Matched person'} was identified with distance ${bestMatch.distance.toFixed(3)}. Redirecting to the information page.`);
        window.location.href = `Information.php?edt=${encodeURIComponent(bestMatch.reference.idNumber)}`;
        return;
      }

      setStatus('error', 'Face not recognized', `No enrolled face matched closely enough. Best distance found: ${bestMatch.distance.toFixed(3)}.`);
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