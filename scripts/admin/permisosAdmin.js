document.addEventListener("DOMContentLoaded", function () {
	const edit = document.getElementById("edit-new");
	const editMaestroModal = document.getElementById("edit");
	const closeEdit = document.getElementById("close-edit");
	const closeEdit2 = document.getElementById("close-edit2");
	const switchButton = document.getElementById("switch-button");
	const switchButtonContainer = document.getElementById(
		"switch-button-container"
	);
	const switchButtonText = document.getElementById("switch-button-text");
	var statusField = document.getElementById("status-field");

	let switchStateModalEdit = true;
	let switchStateButton = true;

	function toggleModalEdit(id) {
		editMaestroModal.classList.toggle("show");
		switchStateModalEdit = !switchStateModalEdit;
		console.log(id);
		document.getElementById("id").value = id;
	}

	if (edit) {
		edit.addEventListener("click", toggleModalEdit);
	}

	if (closeEdit) {
		closeEdit.addEventListener("click", toggleModalEdit);
	}

	if (closeEdit2) {
		closeEdit2.addEventListener("click", toggleModalEdit);
	}

	if (switchButton) {
		switchButton.setAttribute("data-value", "1");
		switchButtonText.innerHTML = "Usuario Activo";
		switchButton.classList.add("switch");
		switchButtonContainer.classList.add("switch");

		switchButton.addEventListener("click", () => {
			if (switchButton.getAttribute("data-value") === "1") {
				switchButton.setAttribute("data-value", "0");
				switchButtonText.innerHTML = "Usuario Inactivo";
				switchButton.classList.remove("switch");
				switchButtonContainer.classList.remove("switch");
			} else {
				switchButton.setAttribute("data-value", "1");
				switchButtonText.innerHTML = "Usuario Activo";
				switchButton.classList.add("switch");
				switchButtonContainer.classList.add("switch");
			}

			// Actualizar el valor del campo oculto con el estado del botón
			statusField.value = switchButton.getAttribute("data-value");
		});
	}

	const editButtons = document.querySelectorAll(".edit-new");

	editButtons.forEach((button) => {
		button.addEventListener("click", function () {
			const id = button.dataset.id;
			toggleModalEdit(id);

			var emailField = document.getElementById("email-edit");
			var idRolField = document.getElementById("rol-edit");
			var xhr = new XMLHttpRequest();
			xhr.open("GET", "/config/db_js.php?id=" + id, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onload = function () {
				if (this.status == 200) {
					var usuario = JSON.parse(this.responseText);
					emailField.value = usuario.email;
					idRolField.value = usuario.id_rol;
					statusField.value = usuario.estado;
				}
			};
			xhr.send("id=" + id);
		});
	});

	document.addEventListener("DOMContentLoaded", function () {
		var emailField = document.getElementById("email");
		var idRolField = document.getElementById("id_rol");
		var statusField = document.getElementById("estado");
		var idField = document.getElementById("id");

		document
			.getElementById("form-edit")
			.addEventListener("submit", function (event) {
				event.preventDefault();

				var xhr = new XMLHttpRequest();
				xhr.open("POST", "/config/db_connect.php", true);
				xhr.setRequestHeader(
					"Content-type",
					"application/x-www-form-urlencoded"
				);
				xhr.onload = function () {
					if (this.status == 200) {
						console.log(this.responseText); // Aquí puedes manejar la respuesta del servidor
					}
				};
				xhr.send(
					"email=" +
						emailField.value +
						"&id_rol=" +
						idRolField.value +
						"&estado=" +
						statusField.value +
						"&id=" +
						idField.value
				);
			});
	});
});
