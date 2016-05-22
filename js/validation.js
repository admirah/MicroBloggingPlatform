var regFormValid = false;
var regValid = true;

function registerValidation() {
    regValid = true;
    document.getElementById("usernameajax").innerHTML = "";
    var k = document.forms["forma"].getElementsByTagName("input");
    for (var i = 0; i < k.length - 1; i++) {
        validation(k[i]);
        if (regFormValid == false) regValid = false;
    }

    if (!regValid || !regFormValid) alert("Some of data is invalid! Please correct it!")

    return regValid && regFormValid;
}


window.onload = function () {
    console.log("admira");


}

function validation(element) {
    if (element.value == "" || element.value == null) {
        if (element.id != "web") {
            element.style.backgroundColor = "#D9837F";
            regFormValid = false;
        } else {
            element.style.backgroundColor = "white";
            regFormValid = true;
        }

    } else {
        if (element.id == "web") {
            element.style.backgroundColor = "white";
            regFormValid = true;
        } else if (element.id == "pass") {
            var regex = /^[a-z0-9]{4,8}$/;
            if (regex.test(element.value)) {
                element.style.backgroundColor = "white";
                regFormValid = true;
            } else {
                element.style.backgroundColor = "#D9837F";
                regFormValid = false;
            }
        } else if (element.id == "date") {
            console.log(element.value);
            var labeladate = document.getElementById("labeladate");
            var k = document.getElementById("dugmic");
            if (meetsMinimumAge(Date.parse(element.value), 18)) {
                regFormValid = true;
                labeladate.style.display = "none";
                k.disabled = false;
                element.style.backgroundColor = "white";
            } else {


                labeladate.style.display = "block";
                regFormValid = false;
                k.disabled = true;
                element.style.backgroundColor = "#D9837F";

            }
        } else {

            element.style.backgroundColor = "white";
            regFormValid = true;
        }

    }
}






function meetsMinimumAge(datum, minAge) {
    var birthDate = new Date(datum);
    var tempDate = new Date(birthDate.getFullYear() + minAge, birthDate.getMonth(), birthDate.getDate());
    return (tempDate <= new Date());
}




function profileValidation() {

    var profValid = true;
    var inputs = document.getElementsByTagName("textarea");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "" || inputs[i].value == null) profValid = false;
    }
    if (!profValid) alert("Your post can't be empty!")

    return profValid;
}

function loginValidation() {

    var loginValid = true;
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length - 1; i++) {
        if (inputs[i].value == "" || inputs[i].value == null) loginValid = false;
    }
    if (!loginValid) alert("Please enter username and password!")

    return loginValid;
}

function indexValidation() {
    var profValid = true;
    var inputs = document.getElementsByTagName("textarea");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "" || inputs[i].value == null) profValid = false;
    }
    if (!profValid) alert("Your post can't be empty!")

    return profValid;
}