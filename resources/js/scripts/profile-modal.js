
const profileModal = document.getElementById('profileModal');
const profileBtn = document.getElementById('profileBtn');

function showProfileModal() {
    profileModal.classList.remove('hidden');
    profileModal.querySelector('.bg-white').classList.add('modal-enter');
    updateProfileData();
}


function closeProfileModal() {
    profileModal.classList.add('hidden');
}

profileBtn?.addEventListener('click', () => {
    showProfileModal();
});


window.showProfileModal = showProfileModal;
window.closeProfileModal = closeProfileModal;