<?php

/**
 * Bit&Black Hyphenizer Bundle.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace BitAndBlack\HyphenizerBundle\Twig;

use BitAndBlack\HyphenizerBundle\AutoHyphenation;
use Generator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HyphenizerTwigExtension extends AbstractExtension
{
    public function getFilters(): Generator
    {
        yield new TwigFilter(
            'hyphenate',
            $this->hyphenate(...),
            [
                'is_safe' => [
                    'html',
                ],
            ],
        );
    }

    /**
     * The hyphenation library is not getting saved here, as this would happen too often.
     * Instead, the {@see HyphenizerLibraryUpdateListener} listens to the end of the
     * request and calls the save method then once.
     */
    private function hyphenate(string|null $input = null): string|null
    {
        if (null === $input) {
            return null;
        }

        return (string) new AutoHyphenation(
            $input,
            updateLibraryWithIncomingWordsEnabled: false
        );
    }
}
