document.getElementById('it-request-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    let isValid = true;
    const formElements = this.elements;
    const confirmationMessage = document.getElementById('confirmation-message');
    
    // Reset previous error states
    for (let i = 0; i < formElements.length; i++) {
        if (formElements[i].type !== "submit") {
            formElements[i].classList.remove('error');
            formElements[i].nextElementSibling.style.display = 'none';
        }
    }
    
    // Validate fields
    if (formElements['first-name'].value.trim() === '') {
        formElements['first-name'].classList.add('error');
        formElements['first-name'].nextElementSibling.style.display = 'block';
        isValid = false;
    }
    
    if (formElements['last-name'].value.trim() === '') {
        formElements['last-name'].classList.add('error');
        formElements['last-name'].nextElementSibling.style.display = 'block';
        isValid = false;
    }
    
    if (formElements['email'].value.trim() === '' || !/\S+@\S+\.\S+/.test(formElements['email'].value.trim())) {
        formElements['email'].classList.add('error');
        formElements['email'].nextElementSibling.style.display = 'block';
        isValid = false;
    }
    
    if (formElements['location'].value.trim() === '') {
        formElements['location'].classList.add('error');
        formElements['location'].nextElementSibling.style.display = 'block';
        isValid = false;
    }
    
    if (formElements['description'].value.trim() === '') {
        formElements['description'].classList.add('error');
        formElements['description'].nextElementSibling.style.display = 'block';
        isValid = false;
    }
    
    if (isValid) {
        confirmationMessage.style.display = 'block';
        setTimeout(() => {
            confirmationMessage.style.display = 'none';
            this.reset();
        }, 3000);
    }
});
