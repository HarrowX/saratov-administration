import Cropper from 'cropperjs';
document.addEventListener('alpine:init', () => {
    Alpine.data('cropper', () => ({
        open: false,
        dontOpen: true,
        file: null,
        cropperInstance: null,

        init() {
            this.$el.addEventListener('file-uploaded', () => {
                const reader = new FileReader();
                reader.onload = async (e) => {
                    const img = this.$refs.cropperImage;

                    if (this.cropperInstance) {
                        this.cropperInstance.destroy();
                    }

                    img.src = e.target.result;

                    await new Promise((resolve) => {
                        if (img.complete) resolve();
                        else img.addEventListener('load', resolve, { once: true });
                    });

                    this.cropperInstance = new Cropper(img);

                    this.toggleModal();
                };
                reader.readAsDataURL(this.file);
            });
        },

        handleFileChange(event) {
            if (this.dontOpen) {
                this.file = event.target.files[0];
                if (!this.file) return;
                this.$dispatch('file-uploaded', { file: this.file });
                this.dontOpen = false;
            }
        },

        async cropImage(id) {
            if (!this.cropperInstance) {
                alert('Error: Cropper not initialized.');
                return;
            }

            const selection = this.cropperInstance.getCropperSelection();
            if (!selection) {
                alert('Error: No selection found.');
                return;
            }

            const croppedCanvas = await selection.$toCanvas();
            if (!croppedCanvas) {
                alert('Error: Failed to get cropped image.');
                return;
            }

            croppedCanvas.toBlob((blob) => {
                if (!blob) {
                    alert('Error: Failed to convert image.');
                    return;
                }
                const mimeType = blob.type;
                const fileName = `cropped-image-${Date.now()}.${mimeType.split('/')[1]}`;
                const croppedFile = new File([blob], fileName, { type: mimeType });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                const fileInput = document.getElementById(id);
                if (fileInput) {
                    fileInput.files = dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
                this.toggleModal();
            });
        },

        toggleModal() {
            this.open = !this.open;
        }
    }));
});
