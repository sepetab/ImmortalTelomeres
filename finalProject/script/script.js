//Input fields
const firstName = document.getElementById('firstName');
const lastName = document.getElementById('lastName');
const roomNumber = document.getElementById('roomNumber');
const password = document.getElementById('password');
const email = document.getElementById('email');
//form
const form = document.getElementById('newPatientForm')
//validation colours
const green = '#4CAF50';
const red = '#F44336'; 

//validation functions
function validateFirstName(){ 
    if(checkIfEmpty(firstName)) return; 
    if(!checkIfOnlyLetters(firstName)) return; 
    return true; 
}

function validateLastName(){
    if(checkIfEmpty(lastName)) return; 
    if(!checkIfOnlyLetters(lastName)) return; 
    return true; 
}

function validateRoomNumber(){
    if(checkIfEmpty(roomNumber)) return;
    if(!checkIfOnlyNumbers(roomNumber)) return;
    return true;
}

function validatePassword() {
    // Empty check
    if (checkIfEmpty(password)) return;
    // Must of in certain length
    if (!meetLength(password, 6, 100)) return;
    // check password against our character set
    // 1- A a 1
    // 2- A a 1 @
    if (!containsCharacters(password, 1)) return;
    return true;
}
function validateEmail() {
    if (checkIfEmpty(email)) return;
    if (!containsCharacters(email, 3)) return;
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
function meetLength(field, minLength, maxLength) {
    if (field.value.length >= minLength && field.value.length < maxLength) {
      setValid(field);
      return true;
    } else if (field.value.length < minLength) {
      setInvalid(
        field,
        `${field.name} must be at least ${minLength} characters long`
      );
      return false;
    } else {
      setInvalid(
        field,
        `${field.name} must be shorter than ${maxLength} characters`
      );
      return false;
    }
}
function containsCharacters(field, code) {
    let regEx;
    switch (code) {
      case 1:
        // uppercase, lowercase and number
        regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
        return matchWithRegEx(
          regEx,
          field,
          'Must contain at least one uppercase, one lowercase letter and one number'
        );
      case 2:
        // uppercase, lowercase, number and special char
        regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/;
        return matchWithRegEx(
          regEx,
          field,
          'Must contain at least one uppercase, one lowercase letter, one number and one special character'
        );
      case 3:
        // Email pattern
        regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return matchWithRegEx(regEx, field, 'Must be a valid email address');
      default:
        return false;
    }
  }
  function matchWithRegEx(regEx, field, message) {
    if (field.value.match(regEx)) {
      setValid(field);
      return true;
    } else {
      setInvalid(field, message);
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
