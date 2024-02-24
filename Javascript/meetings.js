const eventslist = document.querySelector(".events .events-list");

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php1/meetings.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        eventslist.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 10000);
