const form = document.getElementById('form');
const fName = document.getElementById('fName');
const lName = document.getElementById('lName');
const dob = document.getElementById('dob');
const gender = document.getElementById('gender'); 
const email = document.getElementById('email');
const password = document.getElementById('password');
const rePassword = document.getElementById('password2');

form.addEventListener('submit', (e) => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	//trim to remove the whitespaces
	const fNameValue = fName.value.trim();
	const lNameValue = lName.value.trim();
	const dobValue = dob.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim(); 
	const rePasswordValue = rePassword.value.trim();

	if(fNameValue === '') {
		setErrorFor(fName, "First Name cannot be blank");
	} else {
		setSuccessFor(fName); 
	}

	if(lNameValue === '') {
		setErrorFor(lName, "Last Name cannot be blank");
	} else {
		setSuccessFor(lName); 
	}
	
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error'; 
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}