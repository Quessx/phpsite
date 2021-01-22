let pass = document.querySelectorAll('#password');
let email = document.querySelector('#email');
let username = document.querySelector('#username');
let passw = pass[0];
let passw1 = pass[1];
let inp = document.querySelector('#check');

function helper(email, from, to) {
    email.addEventListener("input", () => {
        if (email.value !== '' && email.value.length >= from && email.value.length < to) {
            email.classList = "form-control is-valid";
        }
        else if (email.value === '' || email.value.length < from || email.value.length >= to) {
            email.classList = "form-control is-invalid";
        }
    })
}

function passwords(passw, passw1) {
    passw.addEventListener('input', () => {
        if (passw.value === passw1.value && passw.value.length >= 6) {
            passw.classList = "form-control is-valid";
            passw1.classList = "form-control is-valid";
        }
        else {
            passw.classList = "form-control is-invalid";
            passw1.classList = "form-control is-invalid";
        }
    });
}
helper(email, 3, 23);
helper(username, 4, 16);
passwords(passw, passw1);
passwords(passw1, passw);