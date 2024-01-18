<?php
// src/App/Handler/ListPlayersHandler.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListPlayersHandler implements RequestHandlerInterface
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        // Constructeur qui initialise l'adaptateur de base de données
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            // Création d'une requête SQL pour sélectionner tous les joueurs
            $sql = new Sql($this->adapter);
            $select = new Select('players');
    
            // Préparation et exécution de la requête
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
    
            // Collecte des résultats dans un tableau
            $players = [];
            foreach ($results as $row) {
                $players[] = $row;
            }
    
            // Retourne les données des joueurs en format JSON
            return new JsonResponse($players);
        } catch (\Exception $e) {
            // Gestion des erreurs avec un message d'erreur dans la réponse JSON
            // Remarque : en production, il est préférable de ne pas exposer les détails de l'erreur
            return new JsonResponse(['error' => $e->getMessage()]);
        }
    }
}
?>
