const d = document;

// Manejo del dropdown --> Al elegir un rol, se mostrara elementos en el formulario
let selectedRole = d.querySelector("select").value;
d.querySelector("select").addEventListener("change", function (e) {
  // div donde agregamos el elemento segun la opción elegida
  const div = d.querySelector(".dinamic-element");
  selectedRole = e.target.value;

  if (selectedRole === "cliente")
    div.innerHTML = `<span id="not-registered" class="error" style="display: none"></span>`;
  else if (selectedRole === "asistente") {
    // si el doctor no existe debe registrarlo
    div.innerHTML = `
    <div class="form-input input">
    <label for="doctorEmail">Ingrese el correo del doctor</label>
    <input
      type="email"
      name="doctorEmail"
      id="doctorEmail"
      placeholder="example@email.com"
      required
    />
  </div>
  <span id="not-registered" class="error" style="display: none"
  >Doctor no registrado. Favor registrarlo primero.</span
>
  `;
    isDoctor();
  } else if (selectedRole === "doctor") {
    div.innerHTML = `
    <div class="form-input input">
      <label for="especialidad">Especialidad</label>
      <input type="text" name="especialidad" id="especialidad" required />
  </div>
</div>
<span id="not-registered" class="error" style="display: none"></span>
  `;
  }
});

// Evitamos caracteres "especiales" y NO numericos para el elemento de telefono
d.getElementById("tel").addEventListener("keypress", function (e) {
  if (!/^[0-9]$/.test(e.key)) e.preventDefault();
});

// Manejo de formulario

function isDoctor() {
  d.querySelector("form").addEventListener("submit", function (e) {
    // No se evita el envío del formulario inicialmente

    // Hacemos solicitud al server para confirmar que el doctor exista
    fetch("./doctor.php", {
      method: "POST",
      body: new FormData(this),
    })
      .then((response) => response.json())
      .then((data) => {
        if (!data["registered"]) {
          d.getElementById("not-registered").style.display = "block";
          e.preventDefault(); // Evita el envío del formulario si el doctor no está registrado
        }
      });
  });
}
