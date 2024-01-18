<?php

namespace App\Handler;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Sql;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdatePlayerHandler implements RequestHandlerInterface
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
            // Récupérez l'ID depuis l'URL
            $id = $request->getAttribute('id');
    
            // Récupérez les données du corps de la requête
            $data = $request->getParsedBody();
    
            // Vérifier la présence des clés nécessaires dans les données
            if (!isset($data['score'], $data['treasures_found'], $data['animals_crushed'])) {
                throw new \Exception("Données manquantes pour la mise à jour.");
            }
    
            // Mettez à jour le joueur dans la base de données
            // Exercice: changer pour une requête préparée !
            $sql = 'UPDATE players SET score=?, treasures_found=?, animals_crushed=? WHERE id=?';
            $result = $this->adapter->query($sql, [
                $data['score'],
                $data['treasures_found'],
                $data['animals_crushed'],
                $id
            ]);
    
             // Retourne une réponse en fonction du succès de la mise à jour
            if ($result) {
                return new JsonResponse(['status' => 'success', 'updated_id' => $id]);
            } else {
                throw new \Exception("Échec de la mise à jour du joueur.");
            }
        } catch (\Exception $e) {
              // Gestion des erreurs avec un message d'erreur dans la réponse JSON
            return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()]);
        }
     }
        
}
