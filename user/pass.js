var password = document.getElementById('password');
var toggler = document.getElementById('toggler');

showHiddenPassword = () => {
    if (password.type == 'password'){
        password.setAttribute('type', 'text');
        toggler.classList.add('fa-solid fa-eye-slash');
    }else{
        toogler.classList.remove('fa-solid fa-eye-slash');
        password.setAttribute('type', 'password');
    }
};
toggler.addEventListener('click', showHiddenPassword);