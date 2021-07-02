var reader = new FileReader();

window.previewImage = (input, viewImage) => {
    if (input.files && input.files[0]) {

        reader.onload = function (e) {

            viewImage.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
