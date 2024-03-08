// const menuBtn = document.querySelector(".menu");
// const menu = document.querySelector(".burger");
// const nav = document.querySelector(".nav");
// const menuNav = document.querySelector(".list");
const attenOpt = document.querySelector('.finger-image');
const face = document.querySelector(".face");
const finger = document.querySelector(".finger");
const faceDec = document.querySelector('.container .facedec');
const main = document.querySelector('.container main');
const navItems = document.querySelectorAll(".link");
const punchIneve = document.querySelector('.punch-in');
const punchOuteve = document.querySelector(".punch-out");
const footer = document.querySelector(".footer");
const canvass = document.getElementsByTagName("canvas");
let date = new Date();
let present = "OUT";
let showMenu = false;
const form = document.querySelector(
  ".profile-page .chart_attendance .profile-attendance form"
);
let branch = document.getElementById("branch");
// menuBtn.addEventListener("click", toggleMenu);


let lat, lang;
navigator.geolocation.getCurrentPosition((position) => {
  const { latitude, longitude } = position.coords;
  lat = latitude;
  lang = longitude;
}, (err)=> {
  console.log(err.message);
});

// function toggleMenu() {
//   if (!showMenu) {
//     nav.classList.add("open");
//     nav.style.visibility = "visible";
//     menuBtn.classList.add("open");
//     navItems.forEach((item) => item.classList.add("open"));
//     showMenu = true;
//   } else {
//     nav.classList.remove("open");
//     menuBtn.classList.remove("open");
//     navItems.forEach((item) => item.classList.remove("open"));
//     showMenu = false;
//   }
// }

punchIneve.addEventListener("click", () => {
  attenOpt.style.display = "flex";
  face.style.visibility = "visible";
  finger.style.visibility = "visible";
});

punchOuteve.addEventListener("click", () => {
  attenOpt.style.display = "flex";
  face.style.visibility = "visible";
  finger.style.visibility = "visible";
});

function punchIn() {
  const text = "You are Punched IN !!";
  console.log(text + date);
  confirm(text + "\n\n" + date);

  const speech = new SpeechSynthesisUtterance(text);
  speechSynthesis.speak(speech);

  face.style.visibility = "hidden";
  finger.style.visibility = "hidden";

  present = "IN";
}

function punchOut() {
  const text = "You are Punched OUT !!";
  console.log(text + date);
  confirm(text + "\n\n" + date);
  const speech = new SpeechSynthesisUtterance(text);
  speechSynthesis.speak(speech);
  face.style.visibility = "hidden";
  finger.style.visibility = "hidden";
  present = "OUT";
  attenOpt.style.display = "flex";
}

function faceRecog() {
  faceDec.style.display = "flex";
  faceDec.classList.add("open");
  main.style.visibility = "hidden";

  const video = document.getElementById("video");
  
  Promise.all([
    faceapi.nets.ssdMobilenetv1.loadFromUri("models"),
    faceapi.nets.faceRecognitionNet.loadFromUri("models"),
    faceapi.nets.faceLandmark68Net.loadFromUri("models"),
  ]).then(startWebcam);

  function startWebcam() {
    navigator.mediaDevices
      .getUserMedia({
        video: true,
        audio: false,
      })
      .then((stream) => {
        video.srcObject = stream;
      })
      .catch((error) => {
        console.error(error);
      });
  }

  function getLabeledFaceDescriptions() {
    const labels = ["Sharad", "Messi", "Sonali", "Sharad Tiwari"];
    return Promise.all(
      labels.map(async (label) => {
        const descriptions = [];
        for (let i = 1; i <= 2; i++) {
          const img = await faceapi.fetchImage(`./labels/${label}/${i}.png`);
          const detections = await faceapi
            .detectSingleFace(img)
            .withFaceLandmarks()
            .withFaceDescriptor();
          descriptions.push(detections.descriptor);
        }
        return new faceapi.LabeledFaceDescriptors(label, descriptions);
      })
    );
  }

  video.addEventListener("play", async () => {
    const labeledFaceDescriptors = await getLabeledFaceDescriptions();
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);

    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas, displaySize);

    const res = setInterval(async () => {
      const detections = await faceapi
        .detectAllFaces(video)
        .withFaceLandmarks()
        .withFaceDescriptors();

      const resizedDetections = faceapi.resizeResults(detections, displaySize);

      canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

      const results = resizedDetections.map((d) => {
        return faceMatcher.findBestMatch(d.descriptor);
      });
      results.forEach((result, i) => {
        const box = resizedDetections[i].detection.box;
        const drawBox = new faceapi.draw.DrawBox(box, {
          label: result,
        });
        drawBox.draw(canvas);

        const name = result.label;
        if (name != "unknown" && name != null && name != "" && isNaN(name)) {
          if (video.srcObject && video.srcObject.active) {
            const stream = video.srcObject;
            const tracks = stream.getTracks();
            tracks.forEach((track) => {
              track.stop();
            });
            clearInterval(res);
            video.srcObject = null;
            canvas
              .getContext("2d")
              .clearRect(0, 0, canvas.width, canvas.height);
            if (present === "OUT") {
              punchIn();
              canvas.style.visibility = "hidden";
            } else {
              punchOut();
              canvas.style.visibility = "hidden";
            }
            const xhr = new XMLHttpRequest();
            xhr.open(
              "POST",
              "/Single Project Power - backup/php1/attendance.php",
              true
            );
            xhr.getResponseHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            xhr.onload = () => {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  let data = xhr.response;
                  if (data==="success") {
                    // location.href = "/Single Project Power - backup/profile.php";
                    console.log(data);
                  } else {
                    console.warn(data);
                  }
                }
              }
            };
            var formData = new FormData();
            formData.append("name", name);
            formData.append("latitude", lat);
            formData.append("longitude", lang);
            formData.append("present", present);
            formData.append(
              "branch",
              branch.options[branch.selectedIndex].value
            );
            xhr.send(formData);
          }
          faceDec.style.display = "none";
          faceDec.classList.remove("open");
          main.style.visibility = "visible";
          
        }
      });
    }, 1000);
  });
}

const sndData = () => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/php1/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if ((data = "success")) {
          location.href = "/Front page.html";
        } else {
          console.warn(data);
        }
      }
    }
  };
  xhr.send();
};
