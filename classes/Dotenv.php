<?php

namespace Rtfm2win;

class Dotenv {
    private string $path;

    public function __construct(string $path) {
        $this->path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . '.env';
    }

    public function load(): void {
        if (!file_exists($this->path)) {
            throw new \InvalidArgumentException("Le fichier .env est introuvable : {$this->path}");
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_ENV) && !array_key_exists($name, $_SERVER)) {
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
