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
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        try {
            $sql = new Sql($this->adapter);
            $select = new Select('players');
    
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
    
            $players = [];
            foreach ($results as $row) {
                $players[] = $row;
            }
    
            return new JsonResponse($players);
        } catch (\Exception $e) {
            // Pour le débogage, renvoyez l'erreur directement. Ne faites pas cela en production !
            return new JsonResponse(['error' => $e->getMessage()]);
        }
    }
}
?>
