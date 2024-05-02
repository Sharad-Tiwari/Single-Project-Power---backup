const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php1/login.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = JSON.parse(xhr.response);
        console.log(data);
        if (data.login === "success") {
          if (data.role === "admin") {
            location.href = "admin page/admin.php";
          } else if(data.role==="user"){
            location.href = "profile.php";
          }
        } else {
          errorText.textContent = data.error;
          errorText.style.display = "block";
          
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
