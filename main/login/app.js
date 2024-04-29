let rota = 0;

function switchForms() {
    const sign_in = document.getElementById('sign_in');
    const login = document.getElementById('login');
    

    sign_in.style.left = (sign_in.style.left === '50%') ? '0' : '50%';
    login.style.left = (login.style.left === '100%') ? '50%' : '100%';

    if (rota === 0) {
        rota = 1;
        login.style.zIndex = '0';
        setTimeout(() => {
            sign_in.style.zIndex = '1'
        }, 999);
    }
    else {
        rota = 0;
        sign_in.style.zIndex = '0'
        setTimeout(() => {
            login.style.zIndex = '1';
        }, 999);
    }
}

