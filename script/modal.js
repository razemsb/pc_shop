function openModal() {
    document.getElementById('modal-overlay').style.display = 'block';
    document.getElementById('order-modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal-overlay').style.display = 'none';
    document.getElementById('order-modal').style.display = 'none';
}
document.getElementById('modal-overlay').onclick = closeModal;