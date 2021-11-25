//Input fields
const prescriptionID = document.getElementById('prescriptionID');
var startDate = document.getElementById('startDate');
var finishDate = document.getElementById('finishDate'); 
//validation colours
const green = '#4CAF50';
const red = '#F44336'; 

//validation functions
function validatePrescriptionID(){
    if(checkIfEmpty(prescriptionID)) {return false};
    if(!checkIfOnlyNumbers(prescriptionID)) {return false};
    return true;
}
function validatePrescriptionDate() {
    if(checkIfEmpty(startDate)) {return false};
    if(checkIfEmpty(finishDate)) {return false};
    
    startDate.addEventListener('change', function() {
        if (startDate.value)
            finishDate.min = startDate.value; 
    }, false);
    finishDate.addEventListener('change', function() {
        if (finishDate.value)
            startDate.max = finishDate.value; 
    }, false);
    // if(startDate.getTime() > finishDate.getTime()) {
    //     setInvalid(field, `${field.name} must not be a future date`);
    // }
    // else if(finishDate.getTime() <startDate.getTime()) {
    //     setInvalid(field, `${field.name} must not be a past date`);
    // } else {
    //     setValid(field);
    //     return true;
    // } 
}
// Utility functions
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
//datepicker


// Handling form submit
function validateEditPrescription() {
    return validatePrescriptionID();
}
function validateNewPrescription() {
    return validatePrescriptionDate();
}