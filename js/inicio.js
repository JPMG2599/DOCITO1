const d = document;

const logoutBtn = d.getElementById("logout");

logoutBtn.addEventListener("click", function () {
  if (confirm("¿Está seguro(a) que desea cerrar la sesión?")) {
    // enviar solicitud a PHP para eliminar la sesión
    fetch("logout.php", {
      method: "POST",
    })
      .then((response) => {
        if (response.ok) window.location.href = "./index.php";
      })
      .catch((error) => console.log(`Error al cerrar sesión --> ${error}`));
  }
});
