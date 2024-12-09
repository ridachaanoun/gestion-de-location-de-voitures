let modal = document.getElementById('deleteModal');
let confirmDelete = document.getElementById('confirmDelete');
let clientIdToDelete = null;

// Show the modal and store the client ID
function showModal(clientId) {
    clientIdToDelete = clientId;
    modal.classList.remove('hidden');
}

// Close the modal
function closeModal() {
    modal.classList.add('hidden');
    clientIdToDelete = null;
}

// Redirect to delete the client when confirmed
confirmDelete.onclick = function () {
    if (clientIdToDelete) {
        window.location.href = `delete_client.php?id=${clientIdToDelete}`;
    }
};