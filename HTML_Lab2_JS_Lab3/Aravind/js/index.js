// Toggles validation icon based on input 
function toggleVisibility(toggleCondition,objectToToggle,notEmpty){
    if(toggleCondition){
        objectToToggle.classList.remove("hidden")
        objectToToggle.classList.add("visible")
        objectToToggle.style.color = "green"
        objectToToggle.innerHTML = "valid"   
    }else if(notEmpty){
        objectToToggle.classList.remove("hidden")
        objectToToggle.classList.add("visible")
        objectToToggle.style.color = "red"
        objectToToggle.innerHTML = "invalid"
    }else{
        objectToToggle.classList.remove("visible")
        objectToToggle.classList.add("hidden")
        objectToToggle.innerHTML = "NA"     
    }

}

// validates first name
function validateFirstName() {

    let firstName = document.getElementsByName("firstName")[0]
    let firstNameMessage = document.getElementById("firstNameMessage")
    let regex = /^[A-Za-z\s'-]+$/
    toggleVisibility(regex.test(firstName.value),firstNameMessage,firstName.value)
}

// validates lastName
function validateLastName() {

    let lastName = document.getElementsByName("lastName")[0]
    let lastNameMessage = document.getElementById("lastNameMessage")
    let regex = /^[A-Za-z\s'-]+$/
    toggleVisibility(regex.test(lastName.value),lastNameMessage,lastName.value)

}

// validates Email
function validateEmail(){
    let email = document.getElementsByName("email")[0]
    let emailMessage = document.getElementById("emailMessage")
    let regex = /^[A-Za-z0-9\._-]+@[A-Za-z0-9\.-]+\.[a-zA-z]{2,4}$/
    toggleVisibility(regex.test(email.value),emailMessage,email.value)
}

// validates password 
function validatePassword() {

    let password = document.getElementsByName("password")[0]
    let passwordMessage = document.getElementById("passwordMessage")
    let regex = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/
    toggleVisibility(regex.test(password.value),passwordMessage,password.value)

    // Below condition to toggle help message
    if(passwordMessage.innerHTML == "invalid"){
        document.getElementById("passwordHelp").classList.remove("vanish")
    }else{
        document.getElementById("passwordHelp").classList.add("vanish")
    }

    // Validates password verification field so dynamic if it isnt empty
    validatePassword2()
}

// Validates password verification
function validatePassword2(){
    let password = document.getElementsByName("password")[0]
    let password2 = document.getElementsByName("password2")[0]
    let password2Message = document.getElementById("password2Message")
    toggleVisibility(password.value === password2.value,password2Message,password2.value)
}

// Validates date of birth
function validateDOB(){
    let DOB = document.getElementsByName("DOB")[0]
    let DOBMessage = document.getElementById("DOBMessage")  
    let regex = /^(0?[1-9]|1\d|2\d|3[01])\/(0?[1-9]|1[0-2])\/((19|20)\d{2})$/
    validity = false
    // If regex passes, further validation takes place, else validity remains false
    if (regex.test(DOB.value)){
        const match = DOB.value.match(regex)
        const DOBdate = new Date(match[3], match[2],match[1]);
        const today = new Date();
        console.log(today.getFullYear() - DOBdate.getFullYear())

        // validity ensures correct period and date not in future
        validity = (DOBdate < today) == true && (today.getFullYear() - DOBdate.getFullYear() <=150) ==true
    }

    toggleVisibility(validity,DOBMessage,DOB.value)

    // Below condition to toggle help message
    if(DOBMessage.innerHTML == "invalid"){
        document.getElementById("DOBHelp").classList.remove("vanish")
    }else{
        document.getElementById("DOBHelp").classList.add("vanish")
    }
}


// Refreshes dropdown option upon value change
function refreshDropDown() {
    let DropDown = document.getElementById("genderInput")
    let DropDownDiv = document.getElementById("genderDiv")

    if (DropDown.value) {
        DropDown.value = ''
        DropDownDiv.innerHTML = `<input type="text" autocomplete="off" onchange="validateGender()" onclick="refreshDropDown()" id="genderInput" name="city" list="gender" placeholder="Select/Type Gender" >
        <datalist id="gender">
            <option value="Male">
            <option value="Female">
            <option value="Other">
        </datalist>
        <p id="genderMessage" name="messages" class="hidden">NA</p>`
    }
}

// Validates gender
function validateGender() {
    let DropDown = document.getElementById("genderInput")
    let genderMessage = document.getElementById("genderMessage")
    toggleVisibility(DropDown.value,genderMessage)
}


// Final submit form validation
function validateForm() {
    let messages = document.getElementsByName("messages")

    // Loops to check if all fields contain tick
    for (let message of messages){
        if (message.innerHTML == "valid"){
            continue
        
        // If invalid input, user alerted 
        }else if (message.innerHTML == "invalid"){
            let regex = /([A-Za-z]+)\d?Message/
            const match = message.id.match(regex)
            alert(`Your reponse in the ${match[1]} field is invalid`)
            return false
        
        // If no input, user alerted
        }else if (message.innerHTML == "NA"){
            alert("Registration form incomplete")
            return false
        }
    }

    // Final message to thank user after everything passes
    let firstName = document.getElementsByName("firstName")[0].value
    document.getElementById("email-collector").classList.add("vanish")
    document.getElementById("form-header").innerHTML = `
    Thank you, ${firstName}! Your registration form is completed.`
    return true
}