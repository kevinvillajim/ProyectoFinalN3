//Modal Mensajes

const msg = document.getElementById("msg");
const msgModal = document.getElementById("create");
const closeModal = document.getElementById("close-modal");
const closeModal2 = document.getElementById("close-modal2");

let modalOpen = false;

function toggleModal() {
	if (modalOpen) {
		msgModal.classList.remove("show");
	} else {
		msgModal.classList.add("show");
	}

	modalOpen = !modalOpen;
}

msg.addEventListener("click", toggleModal);
closeModal.addEventListener("click", toggleModal);
closeModal2.addEventListener("click", toggleModal);
