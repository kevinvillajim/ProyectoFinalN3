//Menú de usuario

const modalUser = document.getElementById("modal-user");
const showModal = document.getElementById("show-modal");
const more = document.getElementById("more");

let switchStateModal = true;
showModal.addEventListener("click", () => {
	modalUser.classList.toggle("show");

	if (switchStateModal) {
		more.innerHTML = "expand_less";
		switchStateModal = !switchStateModal;
	} else {
		more.innerHTML = "expand_more";
		switchStateModal = !switchStateModal;
	}
});

//Menú principal

const menuPrincipal = document.getElementById("menu-principal");
const totalContainer = document.getElementById("total-container");
const leftMenu = document.getElementById("left-menu");
const content = document.getElementById("content");

let switchStateMenu = true;
menuPrincipal.addEventListener("click", () => {
	totalContainer.classList.toggle("show");
	leftMenu.classList.toggle("show");

	if (switchStateMenu) {
		switchStateMenu = !switchStateMenu;
	} else {
		switchStateMenu = !switchStateMenu;
	}
});

document.getElementById("logout").addEventListener("click", function () {
	window.location.href = "/models/logout.php";
});
