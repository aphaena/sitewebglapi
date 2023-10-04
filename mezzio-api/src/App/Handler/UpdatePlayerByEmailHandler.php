<?php

// src/App/Handler/UpdatePlayerByEmailHandler.php

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Db\Adapter\Adapter;

class UpdatePlayerByEmailHandler implements RequestHandlerInterface
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();
        
        // Check if email, score, treasures_found, and animals_crushed are set
        if (!isset($data['email'], $data['score'], $data['treasures_found'], $data['animals_crushed'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Invalid data provided']);
        }

        $email = $data['email'];

        // Update the player in the database
        $sql = 'UPDATE players SET score=?, treasures_found=?, animals_crushed=? WHERE email=?';
        $result = $this->adapter->query($sql, [
            $data['score'],
            $data['treasures_found'],
            $data['animals_crushed'],
            $email
        ]);

        if ($result) {
            return new JsonResponse(['status' => 'success', 'updated_email' => $email]);
        } else {
            return new JsonResponse(['status' => 'error', 'message' => 'Failed to update player']);
        }
    }
}
