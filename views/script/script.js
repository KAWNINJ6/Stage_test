/* Birthday select options load */

const CALANDAR = [31,28,31,30,31,30,31,31,30,31,30,31];
const MIN_BIRTHDAY_YEAR = 1920;

const BIRTHDAY_SELECT_DAY = document.getElementById('day');
const BIRTHDAY_SELECT_MONTH = document.getElementById('month');
const BIRTHDAY_SELECT_YEAR = document.getElementById('year');

for (let i = 1; i < CALANDAR[0] + 1; i++) {
    let option = document.createElement('option');
    let day = (i <= 9) ? '0' + i : i;
    option.value = day;
    option.innerHTML = day;
    BIRTHDAY_SELECT_DAY.appendChild(option);
}

for (let i = 1; i < CALANDAR.length + 1; i++) {
    let option = document.createElement('option');
    let month = (i <= 9) ? '0' + i : i;
    option.value = month;
    option.innerHTML = day;
    BIRTHDAY_SELECT_MONTH.appendChild(option);
}

let d = new Date();

for (let i = MIN_BIRTHDAY_YEAR; i <= d.getFullYear(); i++) {
    let option = document.createElement('option');
    option.value = i;
    option.innerText = i;
    BIRTHDAY_SELECT_YEAR.appendChild(option);
}


/* Forms part */

const FORMS = document.getElementsByTagName('form'); 

/* Login form verification */

let errors = [true, true];

FORMS[0].addEventListener('submit', function(e) {
    e.preventDefault();
    let form = e.target;
    let inputs = form.getElementsByTagName('input');
      

    for (let i = 0; i < inputs.length -1 ; i++) {
        if (inputs[i].value === '') {
            errors[i] = true;
            errorStyle(inputs[i]);
        } else {
            errors[i] = false;
            successStyle(inputs[i]);
        }
    }

    if (!errors.includes(true)) {
        console.log('Success');
        ERROR.hidden = true;
        form.submit();
    }
});

/* Register form verification */

const ERROR = FORMS[1].querySelector('[role=alert]');
const ERROR_MSG = 'Veuillez remplir les champs manquants !';
const MAX_INPUTS = FORMS[1].querySelectorAll('input').length;

let checkedInputsErrors = [];

for (let i = 0; i < MAX_INPUTS; i++) {
    checkedInputsErrors[i] = true;
}

FORMS[1].addEventListener('submit', (e) => {
    e.preventDefault(); // prevent form submit
    let form = e.target;
    let inputs = form.getElementsByTagName('input');
    
    // Check if firstname is empty
    if (inputs[1].value === '') {
        checkedInputsErrors[1] = false;
        errorStyle(inputs[1]);
        ERROR.hidden = false;
        ERROR.innerText = ERROR_MSG;
    } else {
        checkedInputsErrors[1] = true;
        successStyle(inputs[1]);
    }

    // Check if lastname is empty
    if (inputs[2].value === '') {
        checkedInputsErrors[2] = false;
        errorStyle(inputs[2]);
        ERROR.hidden = false;
        ERROR.innerText = ERROR_MSG;
    } else {
        checkedInputsErrors[2] = true;
        successStyle(inputs[2]);
    }

    // Check if (phone number || email) are equal or empty
    if (inputs[3].value === '' || inputs[4].value === '') {
        checkedInputsErrors[3, 4] = false;
        errorStyle(inputs[3]);
        errorStyle(inputs[4]);
        ERROR.hidden = false;
        ERROR.innerText = ERROR_MSG;
    } else if (inputs[3].value !== inputs[4].value){
        checkedInputsErrors[3, 4] = false;
        errorStyle(inputs[3]);
        errorStyle(inputs[4]);
        ERROR.hidden = false;
        ERROR.innerText = ERROR_MSG;
    } else {
        checkedInputsErrors[3, 4] = true;
        successStyle(inputs[3]);
        successStyle(inputs[4]);
    }

    // Check if password is empty
    if (inputs[5].value === '') {
        checkedInputsErrors[5] = false;
        errorStyle(inputs[5]);
        ERROR.hidden = false;
        ERROR.innerText = ERROR_MSG;
    } else {
        checkedInputsErrors[5] = true;
        successStyle(inputs[5]);
    }

    // Check if birthday is valid
    if (BIRTHDAY_SELECT_DAY.options[BIRTHDAY_SELECT_DAY.selectedIndex].value === '0' || 
        BIRTHDAY_SELECT_MONTH.options[BIRTHDAY_SELECT_MONTH.selectedIndex].value === '0' || 
        BIRTHDAY_SELECT_YEAR.options[BIRTHDAY_SELECT_YEAR.selectedIndex].value === '0') {
            checkedInputsErrors[9] = false;
            errorStyle(BIRTHDAY_SELECT_DAY);
            errorStyle(BIRTHDAY_SELECT_MONTH);
            errorStyle(BIRTHDAY_SELECT_YEAR);   
            ERROR.hidden = false;
            ERROR.innerText = ERROR_MSG;
    } else {
            checkedInputsErrors[9] = true;
            successStyle(BIRTHDAY_SELECT_DAY);
            successStyle(BIRTHDAY_SELECT_MONTH);
            successStyle(BIRTHDAY_SELECT_YEAR);
    }

    // Submit form if no error
    if (!checkedInputsErrors.includes(true)) {
        ERROR.hidden = true;
        form.submit();
    }
});

// Error style
function errorStyle(input) {
    input.style.border = '1.5px solid red';
}

// Success style
function successStyle(input) {
    input.style.border = '1.5px solid green';
}