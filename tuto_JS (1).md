# Tutoriel JavaScript pour le Projet RTFM2Win

Ce tutoriel présente les principales fonctionnalités JavaScript à implémenter pour le projet RTFM2Win Multijoueur.

## Sommaire
1. [Organisation du code](#1-organisation-du-code)
2. [Communication avec l'API](#2-communication-avec-lapi)
3. [Gestion des participants](#3-gestion-des-participants)
4. [Timer et gestion du temps](#4-timer-et-gestion-du-temps)
5. [Visualisation des données](#5-visualisation-des-données)
6. [Génération de QR Code](#6-génération-de-qr-code)

## 1. Organisation du code

Pour organiser le code JavaScript du projet, nous utiliserons une approche orientée objet avec des classes spécifiques pour chaque fonctionnalité.



**Initialisation de l'application :**
```javascript
// Détection de la page active et chargement du module approprié
document.addEventListener('DOMContentLoaded', () => {
    const page = document.body.dataset.page;
    
    switch(page) {
        case 'join': initJoinPage(); break;
        case 'play': initPlayPage(); break;
        case 'create': initCreatorPage(); break;
        // etc.
    }
});
```

## 2. Communication avec l'API

Pour communiquer avec le backend PHP, nous utiliserons l'API Fetch pour des requêtes AJAX.

**Pseudo-code :**
```
Fonction appelerAPI(endpoint, méthode, données)
    Configurer les options de la requête (méthode, headers, etc.)
    Envoyer la requête avec fetch()
    Si la réponse est OK
        Retourner les données JSON
    Sinon
        Gérer l'erreur
```

**Exemple simplifié :**
```javascript
// Fonction pour soumettre une réponse
async function soumettreReponse(idParticipant, idQuestion, idReponse, tempsReponse) {
    try {
        const response = await fetch('/api/session/submit-answer.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                participant_id: idParticipant,
                question_id: idQuestion,
                reponse_id: idReponse,
                temps_reponse: tempsReponse
            })
        });
        
        return await response.json();
    } catch (error) {
        console.error('Erreur:', error);
    }
}
```

## 3. Gestion des participants

Pour la gestion des participants, nous devons implémenter la logique de connexion et de suivi des réponses.

**Pseudo-code pour rejoindre un quiz :**
```
Au clic sur le bouton "Rejoindre"
    Récupérer et valider le pseudo
    Si le pseudo est valide
        Envoyer requête à l'API pour rejoindre
        Stocker l'ID participant et l'avatar en localStorage
        Rediriger vers la page de jeu
    Sinon
        Afficher message d'erreur
```

**Exemple simplifié :**
```javascript
// Validation du pseudo
function validerPseudo(pseudo) {
    return /^[a-zA-Z0-9_\-\.]{3,20}$/.test(pseudo);
}

// Gestion du formulaire de connexion
document.querySelector('#join-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const pseudo = document.querySelector('#pseudo-input').value.trim();
    
    if (validerPseudo(pseudo)) {
        // Appel API et redirection
        // ...
    }
});
```

## 4. Timer et gestion du temps

Le timer est crucial pour calculer les points en fonction du temps de réponse.

**Pseudo-code :**
```
Initialiser timer avec durée et callbacks
Démarrer le timer
À chaque intervalle (100ms)
    Calculer temps restant
    Mettre à jour l'affichage
    Si temps écoulé
        Appeler callback de fin
```

**Exemple simplifié :**
```javascript
let timer;
let startTime;
let duration = 30; // 30 secondes par défaut

function startTimer() {
    startTime = Date.now();
    
    timer = setInterval(() => {
        const elapsed = (Date.now() - startTime) / 1000;
        const remaining = Math.max(0, duration - elapsed);
        
        // Mise à jour de l'interface
        document.querySelector('#timer-display').textContent = remaining.toFixed(1);
        document.querySelector('#progress-bar').style.width = `${(remaining/duration)*100}%`;
        
        if (remaining <= 0) {
            clearInterval(timer);
            submitAnswer(); // Soumettre automatiquement
        }
    }, 100);
}
```

## 5. Visualisation des données

Pour les graphiques 3D, nous utiliserons charts.css avec quelques ajouts JavaScript pour les animations.

**Pseudo-code pour graphique en barres :**
```
Récupérer les données depuis l'API
Construire un tableau HTML avec classes charts.css
Pour chaque réponse
    Créer une ligne avec taille proportionnelle
    Ajouter des classes spéciales pour bonnes réponses
Ajouter effet 3D avec classes CSS et transitions
```

**Exemple simplifié :**
```javascript
function afficherResultats(donnees) {
    let html = '<table class="charts-css bar show-labels">';
    
    // En-tête
    html += '<thead><tr><th>Réponse</th><th>Nombre</th></tr></thead><tbody>';
    
    // Valeur max pour le scaling
    const max = Math.max(...donnees.map(item => item.nombre));
    
    // Corps du tableau
    donnees.forEach(item => {
        const ratio = item.nombre / max;
        const classe = item.est_correcte ? 'correct-answer' : '';
        
        html += `<tr>
            <td>${item.texte}</td>
            <td style="--size:${ratio}" class="${classe}">
                <span>${item.nombre}</span>
            </td>
        </tr>`;
    });
    
    html += '</tbody></table>';
    
    document.querySelector('#resultats-container').innerHTML = html;
    
    // Ajouter effet 3D après rendu
    setTimeout(() => {
        document.querySelector('table').classList.add('show-3d');
    }, 100);
}
```

**Pseudo-code pour classement 3D Tilt :**
```
Récupérer le top 10 des joueurs
Créer une liste avec les joueurs
Appliquer des transformations CSS 3D
Animer avec des délais progressifs
```

## 6. Génération de QR Code

Pour les QR codes, nous utiliserons une bibliothèque comme qrcode-generator.

**Pseudo-code :**
```
Récupérer le lien du quiz
Créer un objet QR code avec la bibliothèque
Générer le SVG ou Canvas
Insérer dans le conteneur HTML
```

**Exemple simplifié :**
```javascript
function genererQRCode(lien, conteneurId) {
    // Si vous utilisez une bibliothèque comme qrcode.js
    const qr = new QRCode(document.getElementById(conteneurId), {
        text: lien,
        width: 200,
        height: 200
    });
    
    // Ou avec l'API intégrée au navigateur si disponible
    if ('BarcodeDetector' in window) {
        // Utiliser l'API BarcodeDetector
    }
}

// Utilisation
const lienQuiz = "https://monsite.com/quiz/123456";
genererQRCode(lienQuiz, 'qr-container');
```

## Intégration avec le PHP

Les scripts JavaScript communiqueront avec le backend PHP via les endpoints de l'API REST.

**Workflow typique :**
1. L'utilisateur effectue une action (ex: répondre à une question)
2. JavaScript capture l'événement et prépare les données
3. Une requête AJAX est envoyée à l'API PHP
4. Le serveur traite la demande et renvoie une réponse JSON
5. JavaScript met à jour l'interface utilisateur
