//Modal Nuevo Alumno

const createNew = document.getElementById("create-new");
const createAlumnoModal = document.getElementById("create");
const closeCreate = document.getElementById("close-create");
const closeCreate2 = document.getElementById("close-create2");

let switchStateModalNuevo = true;
function toggleModal() {
	createAlumnoModal.classList.toggle("show");
	switchStateModalNuevo = !switchStateModalNuevo;
}

createNew.addEventListener("click", toggleModal);
closeCreate.addEventListener("click", toggleModal);
closeCreate2.addEventListener("click", toggleModal);

//Modal Editar Alumno

const edit = document.getElementsByClassName("edit-new");
const editArray = Array.from(edit);
const editAlumnoModal = document.getElementById("edit");
const closeEdit = document.getElementById("close-edit");
const closeEdit2 = document.getElementById("close-edit2");

let switchStateModalEdit = true;
function toggleModalEdit(alumnoId) {
	const modalEdit = document.getElementById("modal-edit");
	modalEdit.dataset.alumnoId = alumnoId;
	editAlumnoModal.classList.toggle("show");
	switchStateModalEdit = !switchStateModalEdit;
}

closeEdit.addEventListener("click", toggleModalEdit);
closeEdit2.addEventListener("click", toggleModalEdit);

document.addEventListener("DOMContentLoaded", function () {
	const editButtons = document.querySelectorAll(".edit-new");

	editButtons.forEach((button) => {
		button.addEventListener("click", function () {
			const alumnoId = button.dataset.alumnoId;
			toggleModalEdit(alumnoId);
		});
	});
});

function enviarFormulario() {
	const modalEdit = document.getElementById("modal-edit");
	const alumnoId = modalEdit.dataset.alumnoId;

	document.getElementById("alumno-id-edit").value = alumnoId;
}

ocument.querySelectorAll(".edit-button").forEach((button) => {
	button.addEventListener("click", () => {
		document.getElementById("alumno-id-edit").value = button.dataset.id;
		document.getElementById("dni-edit").value = button.dataset.dni;
		document.getElementById("email-edit").value = button.dataset.email;
		document.getElementById("name-edit").value = button.dataset.nombre;
		document.getElementById("direccion-edit").value = button.dataset.direccion;
		document.getElementById("birth-edit").value = button.dataset.nacimiento;
		// Llenar los demás campos del formulario...
	});
});
