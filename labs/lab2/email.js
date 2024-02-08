var shown = false;

function showhideEmail() {
    if (shown) {
        document.getElementById('email').innerHTML = "show my email";
        shown = false;
    } else {
        var emailElement = document.getElementById('email');
        var myemail = "gaddiat@ucmail.uc.edu"; // Default email value
        
        // Validate the email data
        if (typeof myemail !== "undefined" && myemail !== null && myemail.trim() !== "") {
            myemail = "<a href='mailto:" + myemail + "'>" + myemail + "</a>";
        } else {
            myemail = "Email data is not available";
        }

        emailElement.innerHTML = myemail;
        shown = true;
    }
}
