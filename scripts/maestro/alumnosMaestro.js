//Modal Nuevo Alumno

const newGrade = document.getElementById("create-new");
const gradeModal = document.getElementById("create");
const close = document.getElementById("close-create");
const close2 = document.getElementById("close-create2");

let switchStateModalNuevo = true;
function toggleModal() {
	gradeModal.classList.toggle("show");
	switchStateModalNuevo = !switchStateModalNuevo;
}

newGrade.addEventListener("click", toggleModal);
close.addEventListener("click", toggleModal);
close2.addEventListener("click", toggleModal);

//Modal Editar Alumno

const newMsg = document.getElementById("edit-new");
const msgModal = document.getElementById("edit");
const closeMsg = document.getElementById("close-edit");
const closeMsg2 = document.getElementById("close-edit2");

let switchStateModalEdit = true;
function toggleModalEdit() {
	msgModal.classList.toggle("show");
	switchStateModalEdit = !switchStateModalEdit;
}

newMsg.addEventListener("click", toggleModalEdit);
closeMsg.addEventListener("click", toggleModalEdit);
closeMsg2.addEventListener("click", toggleModalEdit);
