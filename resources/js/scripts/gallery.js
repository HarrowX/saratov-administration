import { Fancybox } from "@fancyapps/ui";
import '@fancyapps/ui/dist/fancybox/fancybox.css';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-gallery').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            const galleryName = this.getAttribute('data-gallery');

            if (galleryName) {
                const firstImage = document.querySelector(`[data-fancybox="full-gallery"]`);

                if (firstImage) {
                    firstImage.click();
                }
            }
        });
    });
    Fancybox.bind('[data-fancybox="gallery"]',{});
    Fancybox.bind('[data-fancybox="full-gallery"]',{});
});


window.openFullGallery = function() {
    const firstLink = document.querySelector('[data-fancybox="full-gallery"]');
    if (firstLink) {
        const clickEvent = new MouseEvent('click', {
            view: window,
            bubbles: true,
            cancelable: true
        });
        firstLink.dispatchEvent(clickEvent);
    }
};
