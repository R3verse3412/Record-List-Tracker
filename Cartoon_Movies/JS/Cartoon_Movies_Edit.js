function addCastMember() {
    const container = document.getElementById('cast-container');
    const div = document.createElement('div');
    div.classList.add('cast-member', 'mb-3');
    div.innerHTML = `
        <input type="text" class="form-control mb-2" name="cast_name[]" placeholder="Cast Name">
        <input type="file" class="form-control-file mb-2" name="cast_img[]">
        <button type="button" class="btn btn-danger btn-sm" onclick="removeCastMember(this)">Delete</button>
    `;
    container.appendChild(div);
}

function removeCastMember(button) {
    const div = button.parentElement;
    div.remove();
}