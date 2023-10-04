<?php
// src/App/Handler/UpdateScoreByEmailHandler.php

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Db\Adapter\Adapter;

class UpdateScoreByEmailHandler implements RequestHandlerInterface
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!isset($data['email']) || !isset($data['score'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Missing email or score']);
        }

        $sql = 'UPDATE players SET score = ? WHERE email = ?';
        $result = $this->adapter->query($sql, [$data['score'], $data['email']]);

        if ($result) {
            return new JsonResponse(['status' => 'success', 'message' => 'Score updated successfully']);
        } else {
            return new JsonResponse(['status' => 'error', 'message' => 'Failed to update score']);
        }
    }
}

