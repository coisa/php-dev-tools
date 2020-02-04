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

namespace CoiSA\DevTools\Faker\Provider;

use Faker\Generator;

/**
 * Class ArrayOf
 *
 * @package CoiSA\DevTools\Faker\Provider
 */
final class ArrayOf
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * ArrayOf constructor.
     *
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param callable $factory
     * @param int      $size
     *
     * @return array
     */
    public function arrayOf(callable $factory, $size = null)
    {
        if (null === $size) {
            $size = $this->generator->randomDigitNotNull;
        }

        $arrayOf = [];

        for ($i = 0; $i < $size; $i++) {
            $arrayOf[] = $factory($this->generator);
        }

        return $arrayOf;
    }
}
