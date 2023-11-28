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

	let switchStateModalEdit = true;
	let switchStateButton = true;

	function toggleModalEdit() {
		editMaestroModal.classList.toggle("show");
		switchStateModalEdit = !switchStateModalEdit;
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
		switchButton.dataset.state = "activo";
		switchButtonText.innerHTML = "Usuario Activo";
		switchButton.classList.add("switch");
		switchButtonContainer.classList.add("switch");

		switchButton.addEventListener("click", () => {
			if (switchButton.dataset.state === "activo") {
				switchButton.dataset.state = "inactivo";
				switchButtonText.innerHTML = "Usuario Inactivo";
				switchButton.classList.remove("switch");
				switchButtonContainer.classList.remove("switch");
			} else {
				switchButton.dataset.state = "activo";
				switchButtonText.innerHTML = "Usuario Activo";
				switchButton.classList.add("switch");
				switchButtonContainer.classList.add("switch");
			}

			var xhr = new XMLHttpRequest();
			xhr.open("POST", "update_estado.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send(
				"id=" +
					switchButton.dataset.id +
					"&estado=" +
					switchButton.dataset.state
			);
		});
	}

	let usuarios = Array.from(document.querySelectorAll(".usuario")).map((tr) => {
		return {
			id: tr.dataset.id,
			email: tr.dataset.email,
			rol: tr.dataset.rol,
			estado: tr.dataset.estado,
		};
	});

	console.log(usuarios);

	const editButtons = document.querySelectorAll(".edit-new");

	editButtons.forEach((button) => {
		button.addEventListener("click", function () {
			const id = button.dataset.id;
			toggleModalEdit(id);
		});
	});
});

function toggleModalEdit(id) {
	document.getElementById("id").value = id;
}
