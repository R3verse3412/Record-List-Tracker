function addCastMember() {
    const container = document.getElementById('cast-container');
    const div = document.createElement('div');
    div.classList.add('cast-member', 'mb-3');
    div.innerHTML = `
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="cast_name[]" placeholder="Cast Name" required>
            <input type="file" class="form-control" name="cast_img[]" accept="image/*">
            <button type="button" class="btn btn-danger" onclick="removeCastMember(this)">Delete</button>
        </div>
    `;
    container.appendChild(div);
}

function removeCastMember(button) {
    const castMember = button.closest('.cast-member');
    if (castMember) {
        castMember.remove();
    }
}

// Add event listener to the "Add Cast Member" button
document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('add-cast-member');
    if (addButton) {
        addButton.addEventListener('click', addCastMember);
    }
});