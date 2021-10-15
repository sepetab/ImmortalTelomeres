const primaryForm = document.getElementById("email-collector")

primaryForm.addEventListener("submit", e => {
    e.preventDefault()
    const formData = new FormData(e.target)
    const userFirstName = formData.get("name")
    const userEmailAddress = formData.get("email")
    document.querySelector('.container-main-section').innerHTML = `<h2>Congratulations, ${userFirstName}!</h2>
    <p>You're on your way to becoming a BBQ Master!</p>
    <p class="fine-print">You will get weekly BBQ tips sent to: ${userEmailAddress}</p>`
})
