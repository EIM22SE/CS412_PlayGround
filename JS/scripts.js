// Select the form
const form = document.getElementById('contact-form');

// Add an event listener to the form's submit event
form.addEventListener('submit', function(event) {
    let errorMessage = '';
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const subject = document.getElementById('subject').value; // Get selected subject
    const message = document.getElementById('message').value.trim();

    // Validate form fields
    if (!name) {
        errorMessage += 'Name is required.\n';
    }
    if (!email || !validateEmail(email)) {
        errorMessage += 'A valid email is required.\n';
    }
    if (!phone) {
        errorMessage += 'Phone number is required.\n';
    } else if (!validatePhone(phone)) {
        errorMessage += 'Please enter a valid phone number (e.g., 123-456-7890, (123) 456-7890).\n';
    }
    if (!subject) {
        errorMessage += 'Reason for contact is required.\n';
    }
    if (!message) {
        errorMessage += 'Message is required.\n';
    }

    // Display error message if there are errors
    if (errorMessage) {
        event.preventDefault(); // Prevent form submission
        document.getElementById('error-message').innerText = errorMessage;
        document.getElementById('error-message').style.display = 'block';
    }
});

// Function to validate email
function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email);
}

// Function to validate phone number
function validatePhone(phone) {
    const phoneRegex = /^(\(\d{3}\)\s?|\d{3}[-.\s]?)(\d{3}[-.\s]?)\d{4}$/;
    return phoneRegex.test(phone);
}