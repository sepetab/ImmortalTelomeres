function toggleVisibility(toggleCondition,objectToToggle,notEmpty){
    console.log(toggleCondition)
    if(toggleCondition){
        objectToToggle.classList.remove("hidden")
        objectToToggle.classList.add("visible")
        objectToToggle.innerHTML = "✅"   
    }else if(notEmpty){
        objectToToggle.classList.remove("hidden")
        objectToToggle.classList.add("visible")
        objectToToggle.innerHTML = "❌"
    }else{
        objectToToggle.classList.remove("visible")
        objectToToggle.classList.add("hidden")
        objectToToggle.innerHTML = "NA"     
    }

}


function validateFirstName() {

    let firstName = document.getElementsByName("firstName")[0]
    let firstNameMessage = document.getElementById("firstNameMessage")
    let regex = /^[A-Za-z\s'-]+$/
    toggleVisibility(regex.test(firstName.value),firstNameMessage,firstName.value)
}


function validateLastName() {

    let lastName = document.getElementsByName("lastName")[0]
    let lastNameMessage = document.getElementById("lastNameMessage")
    let regex = /^[A-Za-z\s'-]+$/
    toggleVisibility(regex.test(lastName.value),lastNameMessage,lastName.value)

}

function validateEmail(){
    let email = document.getElementsByName("email")[0]
    let emailMessage = document.getElementById("emailMessage")
    let regex = /^[A-Za-z0-9\._-]+@[A-Za-z0-9\.-]+\.[a-zA-z]{2,4}$/
    toggleVisibility(regex.test(email.value),emailMessage,email.value)
}

function validatePassword() {

    let password = document.getElementsByName("password")[0]
    let passwordMessage = document.getElementById("passwordMessage")
    let regex = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/
    toggleVisibility(regex.test(password.value),passwordMessage,password.value)
    if(passwordMessage.innerHTML == "❌"){
        document.getElementById("passwordHelp").classList.remove("vanish")
    }else{
        document.getElementById("passwordHelp").classList.add("vanish")
    }
    validatePassword2()
}

function validatePassword2(){
    let password = document.getElementsByName("password")[0]
    let password2 = document.getElementsByName("password2")[0]
    let password2Message = document.getElementById("password2Message")
    toggleVisibility(password.value === password2.value,password2Message,password2.value)
}


function validateDOB(){
    let DOB = document.getElementsByName("DOB")[0]
    let DOBMessage = document.getElementById("DOBMessage")  
    let regex = /^(0?[1-9]|1\d|2\d|3[01])\/(0?[1-9]|1[0-2])\/((19|20)\d{2})$/
    if (regex.test(DOB.value)){
        const match = DOB.value.match(regex)
        const DOBdate = new Date(match[3], match[2],match[1]);
        const today = new Date();
        console.log(today.getFullYear() - DOBdate.getFullYear())
        validity = (DOBdate < today) == true && (today.getFullYear() - DOBdate.getFullYear() <=150) ==true
    }else{
        validity = false
    }
    toggleVisibility(validity,DOBMessage,DOB.value)
    if(DOBMessage.innerHTML == "❌"){
        document.getElementById("DOBHelp").classList.remove("vanish")
    }else{
        document.getElementById("DOBHelp").classList.add("vanish")
    }
}


function validateDropDown() {
    let DropDown = document.getElementById("genderInput")
    let DropDownDiv = document.getElementById("genderDiv")

    if (DropDown.value) {
        DropDown.value = ''
        DropDownDiv.innerHTML = `<input type="text" autocomplete="off" onchange="validateGender()" onclick="validateDropDown()" id="genderInput" name="city" list="gender" placeholder="Select/Type Gender" >
        <datalist id="gender">
            <option value="Male">
            <option value="Female">
            <option value="Other">
        </datalist>
        <p id="genderMessage" class="hidden">NA</p>`
    }
}


function validateGender() {
    let DropDown = document.getElementById("genderInput")
    let genderMessage = document.getElementById("genderMessage")
    toggleVisibility(DropDown.value,genderMessage)
}


function validateForm() {
    let messages = document.getElementsByName("messages")
    for (let message of messages){
        if (message.innerHTML == "✅"){
            continue
        }else if (message.innerHTML == "❌"){
            let regex = /([A-Za-z]+)\d?Message/
            const match = message.id.match(regex)
            alert(`Your reponse in the ${match[1]} field is invalid`)
            return false
        }else if (message.innerHTML == "NA"){
            alert("Registration form incomplete")
            return false
        }
    }
    let firstName = document.getElementsByName("firstName")[0].value
    document.getElementById("email-collector").classList.add("vanish")
    document.getElementById("form-header").innerHTML = `
    Thank you for registering, ${firstName}!`
    return true
}