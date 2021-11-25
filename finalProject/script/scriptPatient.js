//Input fields
const firstName = document.getElementById('firstName');
const lastName = document.getElementById('lastName');
const roomNumber = document.getElementById('roomNumber');
//validation colours
const green = '#4CAF50';
const red = '#F44336'; 

//validation functions
function validateFirstName(){ 
    if(checkIfEmpty(firstName)) {return false}; 
    if(!checkIfOnlyLetters(firstName)){return false}; 
    return true; 
}

function validateLastName(){
    if(checkIfEmpty(lastName)) {return false}; 
    if(!checkIfOnlyLetters(lastName)) {return false}; 
    return true; 
}

function validateRoomNumber(){
    if(checkIfEmpty(roomNumber)) {return false};
    if(!checkIfOnlyNumbers(roomNumber)) {return false};
    return true;
}
//Utility functions 
function checkIfEmpty(field){
    if(isEmpty(field.value.trim())){
        //set field invalid 
        setInvalid(field, `${field.name} must not be empty`);
        return true;
    } else {
        //set field valid (not-empty)
        setValid(field); 
        return false; 
    }
}

function isEmpty(value){
    if (value === '') return true; 
    return false; 
}

function setInvalid(field,message){
    field.className = 'invalid';
    field.nextElementSibling.innerHTML = message;
    field.nextElementSibling.style.color = red; 
}
function setValid(field,message){
    field.className = 'valid';
    field.nextElementSibling.innerHTML = '';
    field.nextElementSibling.style.color = green; 
}
function checkIfOnlyLetters(field){
    if(/^[a-zA-Z ]+$/.test(field.value)){
        setValid(field);
        return true;
    } else {
        setInvalid(field, `${field.name} must contain only letters`);
        return false; 
    }
}
function checkIfOnlyNumbers(field){
    if(/^[0-9]+$/.test(field.value)){
        setValid(field);
        return true;
    } else {
        setInvalid(field, `${field.name} must contain only numbers`); 
        return false; 
    }
}
// Image preview
const patientPicture = document.getElementById("patientPicture"); 
const previewContainer = document.getElementById("imagePreview"); 
const previewImage = previewContainer.querySelector(".imagePreviewSample"); 
const previewDefaultText = previewContainer.querySelector(".imagePreviewText");

patientPicture.addEventListener("change", function() {
    const file = this.files[0]; 
    // If file is selected
    if (file) {
        // read as data url
        const reader = new FileReader(); 

        previewDefaultText.style.display = "none"; 
        previewImage.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage.setAttribute("src", this.result); 
        });

        reader.readAsDataURL(file);
    } else {
        // if file is not selected (not working)
        previewDefaultText.style.display = null; 
        previewImage.style.display = null; 
        previewImage.setAttribute("src", ""); 
    }
});

// Handle form validation
function validateNewPatient() {
  return validateFirstName() && validateLastName() && validateRoomNumber();
}
function validateEditPatient() {
  return validateFirstName() && validateLastName() && validateRoomNumber();
}

function validateDebug(){
    console.log(validateNewPatient() && validateFirstName() && validateLastName() && validateRoomNumber() );
}