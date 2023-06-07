<?php

/*
 * This file is part of SyliusFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\SyliusFixturesPlugin\Foundry\Story;

use Akawakaweb\SyliusFixturesPlugin\Foundry\Factory\LocaleFactory;
use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Story;

final class DefaultLocalesStory extends Story implements DefaultLocalesStoryInterface
{
    public function __construct(
        private string $baseLocaleCode,
    ) {
    }

    public function build(): void
    {
        Factory::delayFlush(function () {
            foreach ($this->getLocaleCodes() as $currencyCode) {
                LocaleFactory::new()->withCode($currencyCode)->create();
            }
        });
    }

    /**
     * @return string[]
     */
    private function getLocaleCodes(): array
    {
        $localeCodes = [
            'en_US',
            'de_DE',
            'fr_FR',
            'pl_PL',
            'es_ES',
            'es_MX',
            'pt_PT',
            'zh_CN',
        ];

        if (!in_array($this->baseLocaleCode, $localeCodes, true)) {
            $localeCodes[] = $this->baseLocaleCode;
        }

        return $localeCodes;
    }
}
