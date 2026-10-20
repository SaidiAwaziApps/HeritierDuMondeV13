
/* ************************************************************
 * LORSQUE LE DOM EST CHARGE
 * ***********************************************************/

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[data-media-carousel]').forEach(function (carousel) {

                const slides = Array.from(
                    carousel.querySelectorAll('.media-slide')
                );

        if (slides.length <= 1) {
            return;
        }

        let currentIndex = slides.findIndex(function (slide) {
            return slide.classList.contains('active');
        });

        if (currentIndex < 0) {
            currentIndex = 0;
            slides[0].classList.add('active');
        }

        setInterval(function () {

            slides[currentIndex].classList.remove('active');

            const video = slides[currentIndex].querySelector('video');

            if (video) {
                video.pause();
            }

            currentIndex = (currentIndex + 1) % slides.length;

            slides[currentIndex].classList.add('active');

            const nextVideo = slides[currentIndex].querySelector('video');

            if (nextVideo) {
                nextVideo.play().catch(function () {});
            }

        }, 5000);

    });

});