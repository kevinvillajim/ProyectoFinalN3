//Modal Nuevo Alumno
const createNewAlumno = document.getElementById("create-new");
const createAlumnoModal = document.getElementById("create");
const closeCreateAlumno = document.getElementById("close-create");
const closeCreate2Alumno = document.getElementById("close-create2");

let switchStateModalNuevoAlumno = true;
function toggleModalAlumno() {
	createAlumnoModal.classList.toggle("show");
	switchStateModalNuevoAlumno = !switchStateModalNuevoAlumno;
}

createNewAlumno.addEventListener("click", toggleModalAlumno);
closeCreateAlumno.addEventListener("click", toggleModalAlumno);
closeCreate2Alumno.addEventListener("click", toggleModalAlumno);

//Modal Editar Alumno
const editButtonsAlumno = document.getElementsByClassName("edit-new");
const modalAlumno = document.getElementById("edit");
const closeButtonsAlumno = modalAlumno.getElementsByClassName("close");

function openModalAlumno(alumnoId) {
	const alumno = alumnos.find((a) => a.id === alumnoId);

	document.getElementById("alumno-id-edit").value = alumno.id;
	document.getElementById("dni-edit").value = alumno.dni;
	document.getElementById("email-edit").value = alumno.email;
	document.getElementById("name-edit").value = alumno.nombre;
	document.getElementById("direccion-edit").value = alumno.direccion;
	document.getElementById("birth-edit").value = alumno.nacimiento;

	modalAlumno.classList.add("show");
}

function closeModalAlumno() {
	modalAlumno.classList.remove("show");
}

Array.from(editButtonsAlumno).forEach((button) => {
	button.addEventListener("click", function () {
		const id = button.dataset.alumnoId;
		openModalAlumno(id);
	});
});

Array.from(closeButtonsAlumno).forEach((button) => {
	button.addEventListener("click", closeModalAlumno);
});
