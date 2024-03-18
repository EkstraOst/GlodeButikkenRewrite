document.addEventListener('DOMContentLoaded', function () {
    // Get references to the elements
    let popoutWindowLink = document.getElementById('popoutWindow');
    let overlay = document.querySelector('.overlay');
    let popup = document.querySelector('.popup');
    let closeBtn = document.querySelector('.close-btn');

    // Show the popup window when the link is clicked
    popoutWindowLink.addEventListener('click', function (event) {
        event.preventDefault();
        overlay.style.display = 'block';
        popup.style.display = 'block';
    });

    // Close the popup window when the close button is clicked
    closeBtn.addEventListener('click', function () {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });

    // Close the popup window when the overlay is clicked
    overlay.addEventListener('click', function () {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });

    // Stars
    const stars = document.querySelectorAll(".stars i");

    stars.forEach((star, index) => {
        star.addEventListener("click", () => {
            // Toggle the "active" class for the clicked star
            star.classList.toggle("active");

            // Remove the "active" class from stars after the clicked star
            for (let i = index + 1; i < stars.length; i++) {
                stars[i].classList.remove("active");
            }
        });
    });
});