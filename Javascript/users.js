const searchBar = document.querySelector(".Users .search .null"),
  searchBtn = document.querySelector(".Users .search .button"),
  usersList = document.querySelector(".Users .users-list")
  ;


searchBtn.onclick = () => {
  
  if (searchBar.classList.contains("active")) {
    searchBar.value = "";
    searchBar.classList.remove("active");
    searchBtn.classList.remove("active");
  } else {
    searchBar.classList.add("active");
    searchBtn.classList.add("active");
    searchBar.focus();
  }
};


searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
  if (searchTerm != "") {
    searchBar.classList.add("active");
    searchBtn.classList.add("active");
  } else {
    searchBar.classList.remove("active");
    searchBtn.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php1/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML=data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php1/users.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchBar.classList.contains("active")) {
          usersList.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500);

