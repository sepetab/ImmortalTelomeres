//Input fields
const medID = document.getElementById('medID');
const patientID = document.getElementById('patientID');
const dietID = document.getElementById('dietID'); 

const medName = document.getElementById('medName');
const dosage = document.getElementById('dosage');
const routeAdmin = document.getElementById('routeAdmin');
const food = document.getElementById('food');
const excercise = document.getElementById('excercise');
const beauty = document.getElementById('beauty');
//validation colours
const green = '#4CAF50';
const red = '#F44336'; 

//validation functions
function validatePatientID() {
    if(checkIfEmpty(patientID)) {return false}; 
    if(!checkIfOnlyNumbers(patientID)) {return false};
    return true; 
}
function validateMedID(){
    if(checkIfEmpty(medID)) {return false};
    if(!checkIfOnlyNumbers(medID)) {return false};
    return true;
}
function validateDietID(){
    if(checkIfEmpty(dietID)) {return false};
    if(!checkIfOnlyNumbers(dietID)) {return false};
    return true;
}
// Medication regime
function validateMedName() {
    if(checkIfEmpty(medName)) {return false};
    if(!containsCharacters(medName,4)) {return false};
    return true;
}
function validateDosage() {
    if(checkIfEmpty(dosage)) {return false};
    if(!checkIfOnlyNumbers(dosage)) {return false};
    return true;
}
function validateRouteAdmin() {
    if(checkIfEmpty(routeAdmin)) {return false};
    if(!containsCharacters(routeAdmin,4)) {return false};
    return true;
}
// Diet regime
function validateFood() {
    if(checkIfEmpty(food)) {return false};
    if(!containsCharacters(food,4)) {return false};
    return true;
}
function validateExcercise() {
    if(checkIfEmpty(excercise)) {return false};
    if(!containsCharacters(excercise,4)) {return false};
    return true;
}
function validateBeauty() {
    if(checkIfEmpty(beauty)) {return false};
    if(!containsCharacters(beauty,4)) {return false};
    return true;
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
function containsCharacters(field, code) {
    let regEx;
    switch (code) {
      case 1:
          regEx = /^[A-Za-z\d]{1,3}$/; 
          return matchWithRegEx(
              regEx,
              field, 
              'Should contain either letters or numbers'
          ); 
      case 2:
          regEx = /(?=.*\d)/; 
          return matchWithRegEx(
              regEx,
              field, 
              'Must contain only numbers'
          );
      case 3:
        // lowercase, optional numbers
        regEx = /^[a-zA-Z\d]+$/; 
        return matchWithRegEx(
          regEx, 
          field,
          'Must contain only letters and/or numbers'
        );
      case 4:
        // lowercase, optional numbers
        regEx = /^[a-zA-Z]/; 
        return matchWithRegEx(
          regEx, 
          field,
          'Must contain only letters'
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

// Handling form submit
function validateNewPrescription() {
    return validatePatientID() && validateMedName() && validateDosage() && validateRouteAdmin() && validateFood() && validateExcercise() && validateBeauty();
}
function validateEditPrescription() {
    return validatePatientID() && validateMedID() && validateDietID()&& validateMedName() && validateDosage() && validateRouteAdmin() && validateFood() && validateExcercise() && validateBeauty();
}
