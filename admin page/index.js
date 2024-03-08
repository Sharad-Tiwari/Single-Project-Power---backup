const sideMEnu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn'),
  closeBtn = document.getElementById('close-btn');

const darkMode = document.querySelector('.dark-mode');

menuBtn.addEventListener('click', () => {
  sideMEnu.style.display = 'block';
});


closeBtn.addEventListener("click", () => {
  sideMEnu.style.display = "none";
});

darkMode.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode-variables');
  darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
  darkMode.querySelector("span:nth-child(2)").classList.toggle("active");
})
Orders.forEach(order => {
    const tr = document.createElement('tr');
    const trContent = `
    <td>${order.productName}</td>
    <td>${order.productNumber}</td>
    <td>${order.paymentStatus}</td>
    <td class="${
      order.status === 'Declined'
        ? 'danger'
        : order.status === 'Pending'
        ? 'warning'
        : 'primary'
    }">${order.status}</td>
    <td class="primary">Details</td>
    `;
    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);
})


const chart = document.querySelector('#chart').getContext('2d');

new Chart(chart, {
  type: 'line',
  data: {
    labels: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec',
    ],
    datasets: [
      {
        label: 'BTC',
        data: [
          29374, 33537, 46931, 98768, 34728, 75234, 82340, 23452, 53622, 64356,
          65374, 13221
        ],
        borderColor: 'red',
        borderWidth: 2,
      },
      {
        label: 'ETH',
        data: [
          31500, 41000, 88800, 26000, 46000, 32689, 5000, 3000, 18656, 24832, 36844
        ],
        borderColor: 'blue',
        borderWidth: 2,
      }
    ],
  },
  options: {
    responsive: true,
  },
});