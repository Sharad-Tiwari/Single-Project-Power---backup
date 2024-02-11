let lat, lang;
navigator.geolocation.getCurrentPosition((position) => {
    const { latitude, longitude } = position.coords;
    lat = latitude;
    lang = longitude;
    console.log(lat,lang);
    const KEY = "AIzaSyBjMCoBIUjpQMmEN23f5t9rnLSadX5phAM";
    let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lang}&key=${KEY}`;
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
      })
      .catch((err) => console.warn(err.message));
});
// console.log(this.lat, this.lang);
// const KEY = "AIzaSyDuDlnhcCBvzD_1ixfV-ifZIF-nzCM6kCk";
// let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${this.latitude},${this.longitude}&key=${KEY}`;
// fetch(url)
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
//     })
//     .catch(err => console.warn(err.message));