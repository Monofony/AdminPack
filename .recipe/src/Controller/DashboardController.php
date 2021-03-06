<?php

declare(strict_types=1);

namespace App\Controller;

use Monofony\Contracts\Admin\Dashboard\DashboardStatisticsProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class DashboardController
{
    private DashboardStatisticsProviderInterface $statisticsProvider;
    private Environment $twig;

    public function __construct(DashboardStatisticsProviderInterface $statisticsProvider, Environment $twig)
    {
        $this->statisticsProvider = $statisticsProvider;
        $this->twig = $twig;
    }

    public function indexAction(): Response
    {
        $statistics = $this->statisticsProvider->getStatistics();
        $content = $this->twig->render('backend/index.html.twig', ['statistics' => $statistics]);

        return new Response($content);
    }
}
