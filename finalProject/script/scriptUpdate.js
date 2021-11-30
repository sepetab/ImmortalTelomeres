const MedText = document.getElementById('MedText');

// validate form inputs
function validateMedUpdate() {
    var valid = false;
    if(document.getElementById('MedCheck').checked || document.getElementById('MedRefused').checked || meetLength(MedText, 1, 999)) {
        valid = true;
    }
    else {
        alert('Please complete either checkbox or fill out notes to add additiional information!');
    }
    return valid;
}
// validate 
function meetLength(field, minLength, maxLength) {
    if (field.value.length >= minLength && field.value.length < maxLength) {
      return true;
    } else if (field.value.length < minLength) {
      return false;
    } else {
      return false;
    }
}