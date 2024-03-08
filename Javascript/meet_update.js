const createslide = document.querySelector(
  ".events .events-list .create-container .create"
),
  submitbtn = document.querySelector(".events .events-list .create .submit");

    
let form = document.querySelector(".events .events-list .create .heading form");
const createbtn = document.querySelector('.events .view'),
    eventslist = document.querySelector(".events .events-list .meet_list");

form.onsubmit = (e) => {
  e.preventDefault();
};

createbtn.onclick = () => {
  createslide.style.display = "flex";
};




submitbtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php1/meetings_create.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        createslide.style.display = "flex";
        createslide.innerHTML = data;
        console.log(data);
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
  form.reset();
};

setTimeout(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php1/meet_list.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        eventslist.innerHTML = data;
      }
    }
  };
  xhr.send();
  
},1000 );


setTimeout(() => {
  const cancelbn = document.querySelectorAll(".events .events-list .listbx .cancel"),
    completebtn = document.querySelectorAll(".events .events-list .listbx .complete");
   

cancelbn.forEach(button => {
  button.addEventListener("click", () => {
     let val = button.getAttribute("value");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php1/meet_cancel.php", true);
    xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          console.log(data);
        }
      }
    };
    var sndVal = new FormData();
    sndVal.append("val", val);
    xhr.send(sndVal);
  });
});
  
  completebtn.forEach((button) => {
    button.addEventListener("click", () => {
      let val = button.getAttribute("value");
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php1/meet_complete.php", true);
      xhr.getResponseHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let data = xhr.response;
            console.log(data);
          }
        }
      };
      var sndVal = new FormData();
      sndVal.append("val", val);
      xhr.send(sndVal);
    });
  });
}, 2000);
