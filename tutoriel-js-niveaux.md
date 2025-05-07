# 📘 Tutoriel JavaScript – Fonctions par niveau de difficulté


---

## 🟢 Niveau 1 – Débutant

Les bases indispensables pour manipuler le DOM, créer des variables, réagir aux clics, etc.

| Fonction / Syntaxe | Description |
|--------------------|-------------|
| `let`, `const` | Créer une variable (modif. ou non) |
| `document.querySelector()` | Sélectionne un élément HTML via un sélecteur CSS |
| `document.getElementById()` | Sélectionne un élément via son `id` |
| `addEventListener()` | Réagit à un événement (clic, touche, etc.) |
| `innerHTML` / `textContent` | Modifie le contenu HTML ou texte d’un élément |
| `alert()` | Affiche une alerte |
| `console.log()` | Affiche un message dans la console |
| `prompt()` | Demande une info à l'utilisateur |
| `if`, `else` | Conditions pour faire des choix |
| `function nom()` | Crée une fonction |
| `===` | Vérifie l'égalité stricte (type + valeur) |
| `trim()` | Enlève les espaces d’un texte |
| `/regex/.test()` | Vérifie un format (ex : pseudo valide) |
| `setInterval()` / `clearInterval()` | Lance ou arrête une action répétée |
| `Date.now()` | Donne l'heure actuelle en millisecondes |
| `Math.random()` | Nombre aléatoire entre 0 et 1 |
| `parseInt()`, `parseFloat()` | Transforme du texte en nombre |

---

## 🔵 Niveau 2 – Intermédiaire

Manipulation dynamique du contenu, tableaux, stockage local, gestion des événements.

| Fonction / Syntaxe | Description |
|--------------------|-------------|
| `forEach()` | Parcourt tous les éléments d’un tableau |
| `map()` | Transforme un tableau |
| `filter()` | Garde certains éléments d’un tableau |
| `find()` | Cherche un élément spécifique |
| `includes()` | Vérifie si un élément est présent |
| `classList.add()` / `.remove()` | Ajoute/enlève une classe CSS |
| `createElement()` | Crée un nouvel élément HTML |
| `appendChild()` | Ajoute un élément dans un autre |
| `remove()` | Supprime un élément |
| `event.preventDefault()` | Empêche un comportement par défaut |
| `localStorage.setItem()` / `.getItem()` | Sauvegarde ou lit des données dans le navigateur |
| `JSON.stringify()` / `JSON.parse()` | Transforme objet ⇄ texte JSON |
| `text.replace()` | Remplace un mot/texte dans une chaîne |
| `event.target` | Cible exacte d’un clic ou événement |

---

## 🟣 Niveau 3 – Avancé

Fonctions modernes, asynchrone, classes, architecture modulaire.

| Fonction / Syntaxe | Description |
|--------------------|-------------|
| `fetch()` | Appelle une API |
| `async` / `await` | Attendre un résultat plus proprement |
| `.then()` / `.catch()` | Gestion du succès ou de l’erreur après un `fetch` |
| `try` / `catch` | Tente une action, gère les erreurs |
| `class` | Crée un modèle d’objet (POO) |
| `constructor()` | Initialisation d’une classe |
| `this` | Référence à l’objet courant |
| `import` / `export` | Permet de séparer son code en fichiers |
| `...` (spread/rest) | Copie ou groupe des éléments facilement |
| `?.` (optional chaining) | Accède à une propriété **seulement si elle existe** |
| Bibliothèques : `QRCode`, `BarcodeDetector` | Génération ou lecture de QR Code |

---

## ✅ Conseils

- Utilise la console du navigateur (`F12`) pour tester chaque ligne.
- Commence **niveau 1**, même si tu veux aller vite. Le JS, c’est comme un jeu vidéo : on apprend niveau par niveau.
- Chaque fonction est un **outil** : tu n’as pas besoin de toutes les connaître au début, mais elles seront utiles dans des situations précises.

---

## 🔁 Bonus

| Composant du quizz | Fonctions utiles |
|--------------------|------------------|
| `Affichage question `| innerHTML, createElement, map, forEach
| `Réponse joueur` | addEventListener, event.target, if/else, includes
| `Score` | let score, localStorage, JSON.stringify
| `Timer` | setInterval, clearInterval, Date
| `API PHP` | fetch(), JSON.parse(), async/await, try/catch
| `Enregistrement utilisateur` | localStorage, prompt(), sessionStorage
| `Interface dynamique` | classList.add/remove, DOM, appendChild, remove()
| `Stats en base` | fetch() POST, async/await
