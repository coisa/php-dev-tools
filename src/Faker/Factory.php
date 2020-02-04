<?php

/**
 * This file is part of coisa/dev-tools.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/coisa/dev-tools
 * @copyright Copyright (c) 2019-2020 Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace CoiSA\DevTools\Faker;

use CoiSA\DevTools\Faker\Provider\ArrayOf;
use Faker\Generator;

/**
 * Class Factory
 *
 * @package CoiSA\DevTools\Faker
 */
final class Factory
{
    /**
     * @const string Default locale
     */
    public const DEFAULT_LOCALE = 'pt_BR';

    /**
     * @var array
     */
    private static $defaultProviders = [
        ArrayOf::class,
    ];

    /**
     * @param string $locale
     *
     * @return Generator
     */
    public static function create($locale = self::DEFAULT_LOCALE): Generator
    {
        $generator = \Faker\Factory::create($locale);

        foreach (self::$defaultProviders as $provider) {
            $generator->addProvider(new $provider($generator));
        }

        return $generator;
    }
}
