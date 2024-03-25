const form = document.querySelector(".signup form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};


continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../php1/admin-signup.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log(data);
        if (data === "success") {
          //sending mail from mail.php
          let mailxhr = new XMLHttpRequest();
          mailxhr.open("POST", "../php1/mail.php", true);
          mailxhr.getResponseHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          mailxhr.onload = () => {
            if (mailxhr.readyState === XMLHttpRequest.DONE) {
              if (mailxhr.status === 200) {
                let data = mailxhr.response;
                console.log(data);
                if (data === "success") {
                  console.log("data inserted and mail sent");
                } else {
                  errorText.style.display = "block";
                  errorText.textContent = data;
                }
              }
            }
          };
          let maildata = new FormData(form);
          mailxhr.send(maildata);
          // location.href = "../admin.php";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};