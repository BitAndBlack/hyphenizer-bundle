<?php

/**
 * Bit&Black Hyphenizer Bundle.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

use BitAndBlack\HyphenizerBundle\EventListener\HyphenizerLibraryUpdateListener;
use BitAndBlack\HyphenizerBundle\Twig\HyphenizerTwigExtension;
use Kiwa\Hyphenizer\Command\HyphenationListCreateCommand;
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
    $services->set(HyphenationListCreateCommand::class);
    $services->set(HyphenationListHyphenateCommand::class);
};
