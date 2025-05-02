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
    private string $avatarUrl;
    private string $token;
    private DateTime $tokenExpiresAt;
    private DateTime $createdAt;
    private DateTime $updatedAt;


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
        // Connexion à la base de données
        require_once __DIR__ . '/../config/database.php';


        // Préparation de la requête d'insertion
        $stmt = $this->prepare("INSERT INTO user (username, password, email, role, avatar_url, token, token_Expires_At, created_At, updated_At) VALUES (:username, :password, :email, :role, :avatarUrl, :token, :tokenExpiresAt, :createdAt, :updatedAt)");

        // Liaison des paramètres
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':avatarUrl', $this->avatarUrl);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':tokenExpiresAt', $this->tokenExpiresAt->format('Y-m-d H:i:s'));
        $stmt->bindParam(':createdAt', $this->createdAt->format('Y-m-d H:i:s'));
        $stmt->bindParam(':updatedAt', $this->updatedAt->format('Y-m-d H:i:s'));

        // Exécution de la requête
        if ($stmt->execute()) {
            return (int) $db->lastInsertId();
        } else {
            throw new \Exception("Erreur lors de l'enregistrement de l'utilisateur");
        }
    }

}


