<?php

declare(strict_types=1);

namespace App\Handler;

use Chubbyphp\Container\MinimalContainer;
use DI\Container as PHPDIContainer;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\ServiceManager\ServiceManager;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router\FastRouteRouter;
use Mezzio\Router\LaminasRouter;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Twig\TwigRenderer;
use Pimple\Psr11\Container as PimpleContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HomePageHandler implements RequestHandlerInterface
{
    // Déclaration des propriétés de la classe
    public function __construct(
        private string $containerName,
        private RouterInterface $router,
        private ?TemplateRendererInterface $template = null
    ) {
    }

    // Méthode handle qui est appelée pour chaque requête HTTP correspondant à ce gestionnaire
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        // Switch pour déterminer le conteneur de services utilisé
        switch ($this->containerName) {
            case PimpleContainer::class:
                $data['containerName'] = 'Pimple';
                $data['containerDocs'] = 'https://pimple.symfony.com/';
                break;
            case ServiceManager::class:
                $data['containerName'] = 'Laminas Servicemanager';
                $data['containerDocs'] = 'https://docs.laminas.dev/laminas-servicemanager/';
                break;
            case ContainerBuilder::class:
                $data['containerName'] = 'Symfony DI Container';
                $data['containerDocs'] = 'https://symfony.com/doc/current/service_container.html';
                break;
            case 'Elie\PHPDI\Config\ContainerWrapper':
            case PHPDIContainer::class:
                $data['containerName'] = 'PHP-DI';
                $data['containerDocs'] = 'https://php-di.org';
                break;
            case MinimalContainer::class:
                $data['containerName'] = 'Chubbyphp Container';
                $data['containerDocs'] = 'https://github.com/chubbyphp/chubbyphp-container';
                break;
        }

        // Détermination du routeur utilisé
        if ($this->router instanceof FastRouteRouter) {
            $data['routerName'] = 'FastRoute';
            $data['routerDocs'] = 'https://github.com/nikic/FastRoute';
        } elseif ($this->router instanceof LaminasRouter) {
            $data['routerName'] = 'Laminas Router';
            $data['routerDocs'] = 'https://docs.laminas.dev/laminas-router/';
        }

        // Gestion des moteurs de template
        if ($this->template === null) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the mezzio skeleton application.',
                'docsUrl' => 'https://docs.mezzio.dev/mezzio/',
            ] + $data);
        }

        if ($this->template instanceof PlatesRenderer) {
            $data['templateName'] = 'Plates';
            $data['templateDocs'] = 'https://platesphp.com/';
        } elseif ($this->template instanceof TwigRenderer) {
            $data['templateName'] = 'Twig';
            $data['templateDocs'] = 'https://twig.symfony.com';
        } elseif ($this->template instanceof LaminasViewRenderer) {
            $data['templateName'] = 'Laminas View';
            $data['templateDocs'] = 'https://docs.laminas.dev/laminas-view/';
        }

        // Retourne une réponse HTML en utilisant le moteur de template
        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
