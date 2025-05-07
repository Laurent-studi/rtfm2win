export class User {
    id; //int
    pseudo = ""; //string

    constructor(pseudo /*string*/) {
        this.pseudo = pseudo.toString();
    }

    //User => nouveau User('pseudo') OK
    //Checker dans la base de donnée si le pseudo n'est pas présent dans la partie en cours (plus tard)
    //si c'est vrai, attribue l'id du back dans notre class User.(plus tard)
    //rejoindre la partie

}

let remi = new User(true);
console.log(typeof (remi.pseudo));