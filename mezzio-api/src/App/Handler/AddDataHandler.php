<?php
// src/App/Handler/AddDataHandler.php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddDataHandler implements RequestHandlerInterface
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        // Vérifiez si l'email existe déjà dans la base de données
        $sqlCheck = new Sql($this->adapter);
        $select = $sqlCheck->select()
            ->from('players')
            ->where(['email' => $data['email']]);
        $statement = $sqlCheck->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if ($result->current()) {
            // Si l'email existe déjà, mettez à jour les champs avec des valeurs par défaut
            $sql = 'UPDATE players SET score=0, treasures_found=0, animals_crushed=0 WHERE email=?';
            $this->adapter->query($sql, [$data['email']]);
            return new JsonResponse(['status' => 'success', 'message' => 'Updated existing player']);
        } else {
            // Si l'email n'existe pas, insérez un nouvel enregistrement
            $sql = 'INSERT INTO players (email, score, treasures_found, animals_crushed) VALUES (?, 0, 0, 0)';
            $this->adapter->query($sql, [$data['email']]);
            return new JsonResponse(['status' => 'success', 'message' => 'Added new player']);
        }
    }
}
