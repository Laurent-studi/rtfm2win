# Quiz Interactif Multijoueur

Une application web de quiz interactif multijoueur permettant de créer et de participer à des quiz en temps réel.

## Fonctionnalités

- Création de quiz personnalisés
- Participation sans inscription (pseudo uniquement)
- Avatars aléatoires pour les joueurs
- Système de points basé sur la rapidité de réponse
- Graphiques 3D pour les résultats
- Classement en temps réel
- Interface responsive et moderne

## Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Composer
- Serveur web (Apache/Nginx)

## Installation

1. Cloner le repository :
```bash
git clone https://github.com/votre-username/quiz-interactif.git
cd quiz-interactif
```

2. Installer les dépendances :
```bash
composer install
```

3. Configurer la base de données :
- Créer une base de données MySQL
- Importer le schéma : `database/schema.sql`
- Configurer les accès dans `src/Config/Database.php`

4. Configurer le serveur web :
- Pointer le document root vers le dossier `public`
- Assurer que le mod_rewrite est activé (Apache)

## Structure du projet

```
quiz-interactif/
├── public/              # Point d'entrée public
│   ├── css/            # Styles CSS
│   ├── js/             # Scripts JavaScript
│   └── images/         # Images et avatars
├── src/                # Code source
│   ├── Config/         # Configuration
│   ├── Controllers/    # Contrôleurs
│   ├── Models/         # Modèles
│   ├── Utils/          # Utilitaires
│   └── Views/          # Vues
└── database/           # Schéma et migrations
```

## Utilisation

1. Créer un quiz :
   - Accéder à l'application
   - Cliquer sur "Créer un Quiz"
   - Remplir le formulaire avec les questions
   - Partager le lien généré

2. Participer à un quiz :
   - Utiliser le lien partagé
   - Entrer un pseudo
   - Attendre le début du quiz
   - Répondre aux questions dans le temps imparti

## Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :
1. Fork le projet
2. Créer une branche (`git checkout -b feature/amelioration`)
3. Commiter vos changements (`git commit -am 'Ajout d'une fonctionnalité'`)
4. Pusher sur la branche (`git push origin feature/amelioration`)
5. Créer une Pull Request

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails. 