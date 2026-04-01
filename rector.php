<?php

use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\PHPUnit\CodeQuality\Rector\Class_\PreferPHPUnitThisCallRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Symfony\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector;

return RectorConfig::configure()
    ->withParallel()
    ->withPaths([
        __DIR__,
    ])
    ->withSkip([
        __DIR__ . DIRECTORY_SEPARATOR . 'vendor',
        PreferPHPUnitThisCallRector::class,
        EventListenerToEventSubscriberRector::class,
    ])
    ->withSets([
        PHPUnitSetList::PHPUNIT_120,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        DoctrineSetList::DOCTRINE_CODE_QUALITY,
    ])
    ->withComposerBased(
        phpunit: true,
        symfony: true,
    )
    ->withAttributesSets(
        symfony: true,
        phpunit: true,
    )
    ->withImportNames()
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: true,
        codingStyle: true,
        typeDeclarations: true,
        typeDeclarationDocblocks: true,
    )
;
