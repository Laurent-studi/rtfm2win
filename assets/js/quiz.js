import { User } from "./dashboard.js";

const inputPseudo = document.getElementById('pseudo-input');

document.querySelector('#join-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const pseudo = document.querySelector('#pseudo-input').value.trim();

    if (validerPseudo(pseudo)) {
        inputPseudo.setAttribute('class', 'validPseudo');
        let user = new User(pseudo);
        console.log(user);
    }
    else {
        inputPseudo.setAttribute('class', 'invalidPseudo')
    }
    console.log('test')
});

function validerPseudo(pseudo) {
    let regex = /^[a-zA-Z0-9_\-\.]{3,20}$/;
    return regex.test(pseudo); //retrourne un bool
}

