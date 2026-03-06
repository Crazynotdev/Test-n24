document.addEventListener('DOMContentLoaded', ()=>{
    const forms = document.querySelectorAll('form');
    forms.forEach(f=>{
        f.addEventListener('submit', e=>{
            const recaptcha = f.querySelector('.g-recaptcha-response');
            if(recaptcha && recaptcha.value===''){
                e.preventDefault();
                alert('Merci de valider le captcha');
            }
        });
    });
});
