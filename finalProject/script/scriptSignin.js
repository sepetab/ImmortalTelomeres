//Input fields
const username = document.getElementById('username');
const password = document.getElementById('password');
const email = document.getElementById('email');
//form
const form = document.getElementById('pracLogin')
//validation colours
const green = '#4CAF50';
const red = '#F44336'; 

//validation functions

function validatePassword() {
    // Empty check
    if (checkIfEmpty(password)) {return false};
    // Must of in certain length
    if (!meetLength(password, 6, 100)) {return false};
    // check password against our character set
    // 1- A a 1
    // 2- A a 1 @
    if (!containsCharacters(password, 1)){return false};
    return true;
}

function validateUsername() {
  if (checkIfEmpty(username)) {return false}; 
  if (!containsCharacters(username, 2)) {return false};
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
        // lowercase, optional numbers
        regEx = /^[a-zA-Z\d]+$/; 
        return matchWithRegEx(
          regEx, 
          field,
          'Contain only letters/numbers'
        );
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

// Handle form validation
function validateForm(){
  return validateUsername() && validatePassword();
}

function validateDebug() {
  console.log(validatePassword() && validateUsername());
}