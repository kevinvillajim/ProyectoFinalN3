//Modal Nuevo Maestro

const createNew = document.getElementById("create-new");
const createMaestroModal = document.getElementById("create");
const closeCreate = document.getElementById("close-create");
const closeCreate2 = document.getElementById("close-create2");

let switchStateModalNuevo = true;
function toggleModal() {
	createMaestroModal.classList.toggle("show");
	switchStateModalNuevo = !switchStateModalNuevo;
}

createNew.addEventListener("click", toggleModal);
closeCreate.addEventListener("click", toggleModal);
closeCreate2.addEventListener("click", toggleModal);

//Modal Editar Maestro
const editButtons = document.getElementsByClassName("edit-new");
const modal = document.getElementById("edit");
const closeButtons = modal.getElementsByClassName("close");

function openModal(maestroId) {
	const maestro = maestros.find((m) => m.id === maestroId);

	document.getElementById("maestro-id-edit").value = maestro.id;
	document.getElementById("email-edit").value = maestro.email;
	document.getElementById("name-edit").value = maestro.nombre;
	document.getElementById("direccion-edit").value = maestro.direccion;
	document.getElementById("birth-edit").value = maestro.nacimiento;
	document.getElementById("clase-edit").value = maestro.clase_asignada;

	modal.classList.add("show");
}

function closeModal() {
	modal.classList.remove("show");
}

Array.from(editButtons).forEach((button) => {
	button.addEventListener("click", function () {
		const id = button.dataset.maestroId;
		openModal(id);
	});
});

Array.from(closeButtons).forEach((button) => {
	button.addEventListener("click", closeModal);
});
