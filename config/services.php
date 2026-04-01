<?php

use BitAndBlack\HyphenizerBundle\EventListener\HyphenizerLibraryUpdateListener;
use BitAndBlack\HyphenizerBundle\Twig\HyphenizerTwigExtension;
use Kiwa\Hyphenizer\Command\HyphenationListHyphenateCommand;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->set(HyphenizerLibraryUpdateListener::class);
    $services->set(HyphenizerTwigExtension::class);
    $services->set(HyphenationListHyphenateCommand::class);
};
