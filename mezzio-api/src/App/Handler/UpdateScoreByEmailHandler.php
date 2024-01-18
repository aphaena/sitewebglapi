<?php
// src/App/Handler/UpdateScoreByEmailHandler.php

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Db\Adapter\Adapter;
// Importe les classes nécessaires

class UpdateScoreByEmailHandler implements RequestHandlerInterface
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        // Constructeur qui initialise l'adaptateur de base de données
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();
        // Récupère les données envoyées dans la requête

        // Vérifie si l'email et le score sont présents dans les données
        if (!isset($data['email']) || !isset($data['score'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Missing email or score']);
        }

        // Met à jour le score du joueur dans la base de données
        $sql = 'UPDATE players SET score = ? WHERE email = ?';
        $result = $this->adapter->query($sql, [$data['score'], $data['email']]);

        // Retourne une réponse en fonction du succès de la mise à jour
        if ($result) {
            return new JsonResponse(['status' => 'success', 'message' => 'Score updated successfully']);
        } else {
            return new JsonResponse(['status' => 'error', 'message' => 'Failed to update score']);
        }
    }
}
