<?php

namespace BitAndBlack\HyphenizerBundle\EventListener;

use Kiwa\Hyphenizer\HyphenationLibraryFactory;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;

final class HyphenizerLibraryUpdateListener
{
    #[AsEventListener]
    public function onFinishRequestEvent(FinishRequestEvent $event): void
    {
        HyphenationLibraryFactory::create()->saveLibrary();
    }
}
