//Modal Nueva Clase

const createNew = document.getElementById("create-new");
const createClaseModal = document.getElementById("create");
const closeCreate = document.getElementById("close-create");
const closeCreate2 = document.getElementById("close-create2");

let switchStateModalNuevo = true;
function toggleModal() {
	createClaseModal.classList.toggle("show");
	switchStateModalNuevo = !switchStateModalNuevo;
}

createNew.addEventListener("click", toggleModal);
closeCreate.addEventListener("click", toggleModal);
closeCreate2.addEventListener("click", toggleModal);

// //Modal Editar Clase

const editArray = Array.from(edit);
const editClaseModal = document.getElementById("edit");
const closeEdit = document.getElementById("close-edit");
const closeEdit2 = document.getElementById("close-edit2");
let switchStateModalEdit = true;
function toggleModalEdit(event) {
	const claseId = event.target.dataset.claseId;
	const modalEdit = document.getElementById("modal-edit");
	modalEdit.dataset.claseId = claseId;
	editClaseModal.classList.toggle("show");
	switchStateModalEdit = !switchStateModalEdit;
}
closeEdit.addEventListener("click", toggleModalEdit);
closeEdit2.addEventListener("click", toggleModalEdit);
document.addEventListener("DOMContentLoaded", function () {
	const editButtons = document.querySelectorAll(".edit-new");
	editButtons.forEach((button) => {
		button.addEventListener("click", function (event) {
			toggleModalEdit(event);
		});
	});
});
