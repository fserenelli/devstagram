import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Upload Here',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    init:function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const publicImage = {};
            publicImage.size = 1234;
            publicImage.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, publicImage);
            this.options.thumbnail.call(this, publicImage, `/uploads/${publicImage.name}`);

            publicImage.previewElement.classList.add("dz-success", "dz-complete");
        }
    },
});

dropzone.on("success", function (file, response) {
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on("removedfile", function () {
    document.querySelector('[name="image"]').value = '';
});