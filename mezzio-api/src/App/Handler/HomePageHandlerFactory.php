<?php

declare(strict_types=1);
// Active le mode strict pour les types en PHP

namespace App\Handler;

use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;
// Importe la fonction assert pour les assertions

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        // Récupère le routeur du conteneur de services
        $router = $container->get(RouterInterface::class);
        assert($router instanceof RouterInterface);
        // Vérifie que $router est bien une instance de RouterInterface

        // Tente de récupérer le moteur de template du conteneur, sinon définit à null
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        assert($template instanceof TemplateRendererInterface || null === $template);
        // Vérifie que $template est bien une instance de TemplateRendererInterface ou null

        // Retourne une nouvelle instance de HomePageHandler avec les dépendances injectées
        return new HomePageHandler($container::class, $router, $template);
    }
}
