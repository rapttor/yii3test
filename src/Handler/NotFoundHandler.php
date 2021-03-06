<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Http\Status;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\CurrentRouteInterface;
use Yiisoft\Yii\View\ViewRenderer;

final class NotFoundHandler implements RequestHandlerInterface
{
    private UrlGeneratorInterface $urlGenerator;
    private CurrentRouteInterface $currentRoute;
    private ViewRenderer $viewRenderer;

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        CurrentRouteInterface $currentRoute,
        ViewRenderer $viewRenderer
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->currentRoute = $currentRoute;
        $this->viewRenderer = $viewRenderer->withControllerName('site');
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewRenderer
            ->render('404', ['urlGenerator' => $this->urlGenerator, 'currentRoute' => $this->currentRoute])
            ->withStatus(Status::NOT_FOUND);
    }
}
