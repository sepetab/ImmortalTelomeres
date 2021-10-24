// for values, getElementID works but doesnt output error msg
const fName = document.querySelector('#firstName');
const lName = document.querySelector('#lastName');
const dob = document.querySelector('#dateOfBirth');
const gender = document.querySelector('#gender'); 
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const rePassword = document.querySelector('#confirm-password');

const form = document.querySelector('#sign-up');

//Validating first name and last name 
const checkfName = () => {
	let valid = false; 
	const min = 1, 
		max = 99; 
	const fNameValue = fName.value.trim(); 
	if (!isRequired(fNameValue)) { 
		showError(fName, 'First Name cannot be blank.');
	} else if (!isBetween(fNameValue.Length, min, max)) {
		showError(fName, 'First Name cannot be blank.')
	} else {
		showSuccess(fName);
		valid = true; 
	}
	return valid; 
}
const checklName = () => {
	let valid = false; 
	const min = 1, max = 99; 
	const lNameValue = lName.value.trim(); 
	if (!isRequired(lNameValue)) { 
		showError(lName, 'Last Name cannot be blank.');
	} else if (!isBetween(lNameValue.Length, min, max)) {
		showError(lName, 'Last Name cannot be blank.')
	} else {
		showSuccess(lName);
		valid = true; 
	}
	return valid; 
}

// Validating email address from recipient
// checks if email address provided is valid 
const checkEmail = () => {
	let valid = false; 
	const emailValue = email.value.trim();
	if (!isRequired(emailValue)) {
		showError(email, 'Email cannot be blank.')
	} else if (!isEmailValid(emailValue)) {
		showError(email, 'Email is not valid, must follow format of {name}@example.com')
	} else {
		showSuccess(email); 
		valid = true; 
	}
	return valid; 
}

//Validating password 
// checks if passsword field provided matches the required format 
const checkPassword = () => { 
	let valid = false;
	const passwordValue = password.value.trim();
	if (!isRequired(passwordValue)) { 
		showError(password, 'Password cannot be blank.')
	} else if (!isPasswordSecure(passwordValue)) {
		showError(password, 'Password must have at least 8 characters that include: at least 1 lowercase character, 1 uppercase character, 1 number, and 1 special character from (!@#$%^&*)')
	} else {
		showSuccess(password); 
		valid = true;
	}
	return valid;
}

//validating password confirmation 
// checks if the confirmed password is the same as the password
const checkConfirmPassword = () => {
	let valid = false; 
	const rePasswordValue = rePassword.value.trim();
	const passwordValue = password.value.trim();
	if (!isRequired(rePasswordValue)) {
		showError(rePassword, 'Please enter the password again.')
	} else if (passwordValue !== rePasswordValue) {
		showError(rePassword, 'Confirmation password does not match')
 	} else {
		showSuccess(rePassword);
		valid = true;
	 }
	 return valid; 
}
const checkDate = () => {
	let valid = false;
	const dobValue = dob.value.trim();
	if (!isRequired(dobValue)) {
		showError(dob, 'Please enter in your Birth Date in the correct format')
	}
	else if (!isDateValid(dobValue)) {
		showError(dob, 'Date of birth should be in dd/mm/yyyy format')
	}
	else {
		showSuccess(dob);
		valid = true; 
	}
	return valid; 
}

	// call each individual functon to determine if form is valid. 
	let isfNameValid = checkfName(),
		islNameValid = checklName(),
		isEmailValid = checkEmail(), 
		isPasswordValid = checkPassword(),
		isRePasswordValid = checkConfirmPassword(); 
		isDateValid = checkDate(); 
	
	let isFormValid = isfNameValid && 
		islNameValid && 
		isEmailValid && 
		isPasswordValid &&
		isRePasswordValid &&
		isDateValid; 

// prevent submit button from submitting and refreshing the page
form.addEventListener('submit', (e) => {
	 validationForm(); 

	 if (!validationForm()){
		 e.preventDefault;
	 }
	// prevent form from submittin

	
	// // submit to server if the form is valid
	// if (isFormValid !== true) {
	// 		e.preventDefault();
	// 	}
});

// reusable utility functions // 
// function returns true if the inptu argument is empty
const isRequired = value => value === '' ? false : true;
//function returns false if lenght argument is not between the max and min
const isBetween = (length, min, max) => length < min || length > max ? false : true;
// function checks is email is valid
const isEmailValid = (email) => {
	const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
//check is password is wrong, with specified pattern
	// ^ = password starts
	// (?=.*[a-z]) = password contains one lower case
	// (?=.*[A-Z]) = password contians one upper case
	// (?=.*[0-9]) = password contiains at least one number
	// (?=.*[!@#$%^&*]) = passsword contains a special character
	// (?=.{8,}) = must be eight chracters or longer
const isPasswordSecure = (password) => {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return re.test(password);
};
//check if date of birth is in correct format 
const isDateValid = (dob) => {
	const re = /^(0?[1-9]|1\d|2\d|3[01])\/(0?[1-9]|1[0-2])\/((19|20)\d{2})$/
	return re.test(dob);
}

// const isGenderValid = (gender) =>
//functions for error/success messages//
//error message
const showError = (input, message) => {
    // get the form-field element, since form-field is parent of input
    const formField = input.parentElement;
    // remove success to add error class
    formField.classList.remove('success');
    formField.classList.add('error');
	// show error message
    // select <small> inside form-field element 
    const error = formField.querySelector('small');
	//set error messsage to textContent, in the property of small 
    error.textContent = message;
};
// success message and set error message to be blank
const showSuccess = (input) => { 
	//get the form-field element 
	const formField = input.parentElement;
	//remove error class to add success error: 
	formField.classList.remove('error');
	formField.classList.add('success');
	// hide error message
	const error = formField.querySelector('small');
	error.textContent ='';
}

function validationForm() {
	if (checkfName()){
		alert('Fk up noob')
		return false; 
	} else {
		return true;
	}
}