document.addEventListener("DOMContentLoaded", function() {
    // Get the form element
    let form = document.querySelector('form');

    // Add a submit event listener to the form
    form.addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the values from the form fields
        let rating = document.getElementById('yourInput').value;
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;

        // Log the values to the console
        console.log("Din vudering: " + rating);
        console.log("Navn: " + name);
        console.log("E-post: " + email);

        // You can also send this data to a server using AJAX if needed

        // Reset the form if necessary
        form.reset();
    });
});

document.addEventListener('DOMContentLoaded', function () {
   let quantityInput = document.getElementById('quantity');
    let form = document.getElementById('cartForm');

    // Add event listener for changes in quantity
    quantityInput.addEventListener('input', function () {
        // You can perform actions here, e.g., update total price
        updateTotalPrice();
    });

    // Function to update total price (replace this with your logic)
    function updateTotalPrice() {
        // Example: Get quantity value and calculate total price
        let quantity = parseInt(quantityInput.value);
        let unitPrice = 10; // Replace with your actual unit price
        let totalPrice = quantity * unitPrice;

        // Display or use the total price as needed
        console.log('Total Price: $' + totalPrice);
    }

    // Add other event listeners or functions as needed

    // Prevent the default form submission for demonstration purposes
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        // Perform your form processing logic here
        console.log('Form submitted!');
    });
});