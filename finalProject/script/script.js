//Input fields
const firstName = document.getElementById('firstName');
const lastName = document.getElementById('lastName');
const dateDay = document.getElementById('dateDay');
const dateMonth = document.getElementById('dateMonth');
const dateYear = document.getElementById('dateYear');
const contactNo = document.getElementById('contactNo');
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

function validateDateDay(){
    if(checkIfEmpty(dateDay)) return;
    
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