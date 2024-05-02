const chart = document.querySelector("#chart").getContext("2d");
let DataIn, outData;

const sideMEnu = document.querySelector("aside");
const menuBtn = document.getElementById("menu-btn"),
  closeBtn = document.getElementById("close-btn");

const activemenu = document.querySelectorAll(".container .sidebar a");

const darkMode = document.querySelector(".dark-mode");

menuBtn.addEventListener("click", () => {
  sideMEnu.style.display = "block";
});

activemenu.forEach((element) => {
  element.addEventListener("click", () => {
    if (element.classList.contains("active")) {
      element.classList.remove("active");
    } else {
      activemenu.forEach((el) => {
        el.classList.remove("active");
      });
      element.classList.add("active");
    }
  });
});

closeBtn.addEventListener("click", () => {
  sideMEnu.style.display = "none";
});

darkMode.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode-variables");
  darkMode.querySelector("span:nth-child(1)").classList.toggle("active");
  darkMode.querySelector("span:nth-child(2)").classList.toggle("active");
});
Orders.forEach((order) => {
  const tr = document.createElement("tr");
  const trContent = `
    <td>${order.productName}</td>
    <td>${order.productNumber}</td>
    <td>${order.paymentStatus}</td>
    <td class="${
      order.status === "Declined"
        ? "danger"
        : order.status === "Pending"
        ? "warning"
        : "primary"
    }">${order.status}</td>
    <td class="primary">Details</td>
    `;
  tr.innerHTML = trContent;
  document.querySelector("table tbody").appendChild(tr);
});

const xhr = new XMLHttpRequest();
xhr.open("GET", "../attendance/get-attendance.php", true);
xhr.onload = () => {
  if (xhr.readyState == XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
      let data = xhr.response;
      if (data === "No data Found") {
        console.log("No data");
      } else {
        DataIn = JSON.parse(data);
        console.log(DataIn);
      }
    }
  }
};
xhr.send();

const xhr2 = new XMLHttpRequest();
xhr2.open("GET", "../attendance/attendance-out.php", true);
xhr2.onload = () => {
  if (xhr2.readyState == XMLHttpRequest.DONE) {
    if (xhr2.status === 200) {
      let data = xhr2.response;
      if (data === "NO data Found") {
        console.log("No data");
      } else {
        outData = JSON.parse(data);
        console.log(outData);
      }
    }
  }
};
xhr2.send();

setTimeout(
  () => {
    new Chart(chart, {
      type: "line",
      data: {
        labels: outData.day,
        datasets: [
          {
            label: "IN",
            data: DataIn,
            borderColor: "green",
            borderWidth: 2,
          },
          {
            label: "OUT",
            data: outData.time,
            borderColor: "red",
            borderWidth: 2,
          },
        ],
      },
      options: {
        responsive: true,
      },
    });
  },

  2000
);
