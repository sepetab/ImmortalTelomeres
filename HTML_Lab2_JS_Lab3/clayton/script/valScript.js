// Animation for overlay sidepanel to follow through when overlay button is clicked
document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);

// Form validation code for each section in registeration
const fName = document.getElementById('firstName');
const lName = document.getElementById('lastName');
const dob = document.getElementById('DOB');
const gender = document.getElementById('gender');
const email = document.getElementById('email');
const pass = document.getElementById('pass');
const rePass = document.getElementById('rePass'); 

form.addEventListener("submit", e => {
    e.preventDefault();

    checkInputs();
})

function checkInputs() {
    // Trimmmed constants from the variables to remove whitespace
    const fNameValue = fName.value.trim();
    const lNameValue = lName.value.trim();
    const dobValue = dob.value.trim();
    const genderValue = gender.value.trim();
    const emailValue = email.value.trim();
    const passValue = pass.value.trim();
    const rePassValue = rePass.value.trim();

    if(fNameValue === '') {
        setErrorFor(fName, "First Name cannot be blank");
    } else {
        setSuccessfor(fName); 
    } 
}

function setErrorFor(input, message) {
    const form = input.parentElement;
    const small = form.querySelector('small');

    // add error message inside small 
    small.innerText = message; 

    //add error class
    form.className = "form error";
}


// // Prevent page from submitting blank
// form.addEventListener("submit", (e) => {
//     let messages = [] 
//     // check if user inserted anything for first name 
//     if (fNameValue === '' || fNameValue == null) {
//         messages.push('First Name is required')
//     } 

//     // if there is some form of error, perform the message respective to error 
//     if (messages.Length > 0) {
//         e.preventDefault();
//         errorElement.innerText = messages.join(', ')
//     }
// })

// function checkInputs() {
//     // get values from the inputs and trim them, to remove white space

//     if(fNameValue === '') {
//         //show error
//         setErrorFor(firstName,'First Name cannot be blank');
//     } else { 
//         // add success 
//         setSuccessfor(firstName);
//     }
// }

// function setErrorFor(input,message) { 
//     const form = input.parentElement;
//     const small = form.querySelector('small'); 

//     //add error message inside small 
//     small.innerText = message;

// }