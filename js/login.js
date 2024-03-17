const d = document;

d.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault();

  fetch("./login.php", {
    method: "POST",
    body: new FormData(this),
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "") {
        window.location.href = "./inicio.html";
      } else {
        d.getElementById("error").style.display = "block";
      }
    });
});
