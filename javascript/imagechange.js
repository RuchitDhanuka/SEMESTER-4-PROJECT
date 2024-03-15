document.addEventListener('DOMContentLoaded', function () {

    var images = document.querySelectorAll('.image-slider img');
    var currentIndex = 0;

    function showNextImage() {
      images[currentIndex].style.display = 'none';

      currentIndex = (currentIndex + 1) % images.length;

      images[currentIndex].style.display = 'block';
    }
    images[currentIndex].style.display = 'block';

    setInterval(showNextImage, 1000);
  });