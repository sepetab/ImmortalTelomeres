//Input fields
const medID = document.getElementById('medID');
const patientID = document.getElementById('patientID');
const dietID = document.getElementById('dietID'); 

const medName = document.getElementById('medName');
const dosage = document.getElementById('dosage');
const routeAdmin = document.getElementById('routeAdmin');
const food = document.getElementById('food');
const exercise = document.getElementById('exercise');
const beauty = document.getElementById('beauty');
const presOpt = document.getElementById('prescriptionOption');
const prescriptionForm = document.getElementById('prescriptionForm');
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
    if(!containsCharacters(medName,1)) {return false};
    return true;
}
function validateDosage() {
    if(checkIfEmpty(dosage)) {return false};
    if(!checkIfOnlyNumbers(dosage)) {return false};
    return true;
}
function validateRouteAdmin() {
    if(checkIfEmpty(routeAdmin)) {return false};
    if(!containsCharacters(routeAdmin,1)) {return false};
    return true;
}
// Diet regime
function validateFood() {
    if(checkIfEmpty(food)) {return false};
    return true;
}
function validateExercise() {
    if(checkIfEmpty(exercise)) {return false};
    if(!containsCharacters(exercise,1)) {return false};
    return true;
}
function validateBeauty() {
    if(checkIfEmpty(beauty)) {return false};
    if(!containsCharacters(beauty,1)) {return false};
    return true;
}
// Utility functions
function checkIfEmpty(field){
    if(isEmpty(field.value.trim())){
        //set field invalid
        
        if (field.name == "Food" || field.name == "Exercise" || field.name == "Beauty"){
            setInvalid(field, 'At least one of the regimes must be filled');
        }else{
            setInvalid(field, `${field.name} must not be empty`);
        }
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
        // lowercase, optional numbers
        regEx = /[a-zA-Z]+$/; 
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
// validateDateRange
var startDate; 
$('#startDate').on('change', function() {
    startDate = $(this).val();
    $('#finishDate').prop('min', function(){
        return startDate;
    })
})
var finishDate; 
$('#finishDate').on('change', function() {
    finishDate = $(this).val();
    $('#startDate').prop('max', function(){
        return finishDate;
    })
})
// validateCheckBox 
function validateCheckBox(){
    var valid = false;
    
    if(document.getElementById("morning").checked) {
        valid = true; 
    }
    else if (document.getElementById("afternoon").checked) {
        valid = true; 
    }
    else if (document.getElementById("evening").checked) {
        valid = true; 
    }else{
        alert('Select at least one time slot'); 
    }
    return valid;
}
// OptionSelector

function OptionsToggler(){

    if (presOpt.value == 'diet') {
        dietFields = document.getElementsByClassName('DROpt')
        medFields = document.getElementsByClassName('medOpt')
        for (let dietField of dietFields){
            dietField.style.display = "block"
        }
        for (let medField of medFields){
            medField.style.display = "none"
        }
        prescriptionForm.action = "dietRegimes.php"
        prescriptionForm.setAttribute("onsubmit", "return validateNewDietPrescription()");  
    }else {
        dietFields = document.getElementsByClassName('DROpt')
        medFields = document.getElementsByClassName('medOpt')
        for (let dietField of dietFields){
            dietField.style.display = "none"
        }
        for (let medField of medFields){
            medField.style.display = "block"
        }
        prescriptionForm.action = "medications.php"
        prescriptionForm.setAttribute("onsubmit", "return validateNewMedPrescription()");     
    }
}

// Handling form submit
function validateNewMedPrescription() {
    console.log(validatePatientID()  && validateCheckBox() && validateMedName() && validateDosage() && validateRouteAdmin());
    return validatePatientID()  && validateCheckBox() && validateMedName() && validateDosage() && validateRouteAdmin();
}
function validateNewDietPrescription() {
    console.log(validatePatientID()  && validateExercise() && validateFood() && validateBeauty());
    return validatePatientID() && validateCheckBox() && (validateExercise() || validateFood() || validateBeauty());
}


