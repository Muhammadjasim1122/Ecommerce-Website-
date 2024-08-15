function showUpdateForm(id, name, price, quantity, image) {
    // Set the form fields
    document.getElementById('update_id').value = id;
    document.getElementById('update_name').value = name;
    document.getElementById('update_price').value = price;
    document.getElementById('update_quantity').value = quantity;
    
    // Update the current image display
    const currentImage = document.getElementById('currentImage');
    if (image) {
        currentImage.src = `/E_Commercenew/E_Commerce/${image}`;
        currentImage.style.display = 'block'; // Show the image
    } else {
        currentImage.src = '';
        currentImage.style.display = 'none'; // Hide if no image
    }

    // Show the modal
    $('#updateFormModal').modal('show');
}

