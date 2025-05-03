<?php

namespace Rtfm2win;
use DateTime;



// Déclaration d'encodage UTF-8
header('Content-Type: text/html; charset=utf-8');



class User
{
    //-----------------------Attributs--------------------------
    private string $username;
    private string $password;
    private string $email;
    private string $role = 'PLAYER';
    private string $avatarUrl ='';
    private string $token;
    private DateTime $tokenExpiresAt;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    private $pdo;
    //-----------------------Constructeur--------------------------
    public function __construct()
    {
        $this->pdo = include __DIR__ . '/../config/database.php';
        if (!$this->pdo) {
            throw new \Exception("Erreur : Impossible d'établir une connexion à la base de données.");
        }
    }

    //-----------------------Accesseurs--------------------------
    public function getUserName(): string
    {
        return $this -> username;
    }

    public function getPassword(): string
    {
        return $this -> password;
    }

    public function getEmail(): string
    {
        return $this -> email;
    }

    public function getRole(): string
    {
        return $this -> role;
    }

    public function getAvatarUrl(): string
    {
        return $this -> avatarUrl;
    }

    public function getToken(): string
    {
        return $this -> token;
    }

    public function getTokenExpiresAt(): DateTime
    {
        return $this -> tokenExpiresAt;
    }

    public function getCreatedAt(): DateTime
    {
        return $this -> createdAt;
    }

    public function getUpdateAt(): DateTime
    {
        return $this -> updatedAt;
    }

    //-----------------------Mutateurs--------------------------

    public function setUserName(string $username)
    {
        
        $this -> username = $username;
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setEmail(string $email)
    {
        $this -> email = $email;
    }

    public function setRole(string $role)
    {
        $this -> role = $role;
    }

    public function setAvatarUrl(string $avatarUrl)
    {
        $this -> avatarUrl = $avatarUrl;
    }

    public function setToken(string $token)
    {
        $this -> token = $token;
    }

    public function setTokenExpiresAt(DateTime $tokenExpiresAt)
    {
        $this -> tokenExpiresAt = $tokenExpiresAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this -> createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this -> updatedAt = $updatedAt;
    }


//-------------------------------------------------
//methode save() manquante a créé ici
    public function save()
    {
        if (!$this->pdo instanceof \PDO) {
            throw new \Exception("Erreur : La connexion PDO n'est pas valide.");
        }

        // Utilisation de la connexion PDO de l'attribut $this->pdo
        $stmt = $this->pdo->prepare("INSERT INTO user (username, password, email, role, avatar_url, token, token_Expires_At, created_At, updated_At) 
                        VALUES (:username, :password, :email, :role, :avatarUrl, :token, :tokenExpiresAt, :createdAt, :updatedAt)");

        // Initialisation des dates
        $now = new DateTime();
        $this->createdAt = $now;
        $this->updatedAt = $now;
        $this->tokenExpiresAt = (clone $now)->modify('+1 day');
        $this->token = bin2hex(random_bytes(16));

        // Liaison des paramètres
        $stmt->bindValue(':username', $this->username);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':role', $this->role);
        $stmt->bindValue(':avatarUrl', $this->avatarUrl);
        $stmt->bindValue(':token', $this->token);
        $stmt->bindValue(':tokenExpiresAt', $this->tokenExpiresAt->format('Y-m-d H:i:s'));
        $stmt->bindValue(':createdAt', $this->createdAt->format('Y-m-d H:i:s'));
        $stmt->bindValue(':updatedAt', $this->updatedAt->format('Y-m-d H:i:s'));

        // Exécution de la requête
        if ($stmt->execute()) {
            return (int) $this->pdo->lastInsertId();
        } else {
            throw new \Exception("Erreur lors de l'enregistrement de l'utilisateur");
        }
    }
}

