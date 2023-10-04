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

        // Validate data...
        
        $sql = 'INSERT INTO players (email, score, treasures_found, animals_crushed) VALUES (?, ?, ?, ?)';
        $result = $this->adapter->query($sql, [
            $data['email'],
            $data['score'],
            $data['treasures_found'],
            $data['animals_crushed']
        ]);

        if ($result) {
            return new JsonResponse(['status' => 'success']);
        } else {
            return new JsonResponse(['status' => 'error']);
        }
    }
}
