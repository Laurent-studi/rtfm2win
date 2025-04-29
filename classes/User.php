<?php

namespace Rtfm2win;

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

    public function setUsername(string $username)
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
}
