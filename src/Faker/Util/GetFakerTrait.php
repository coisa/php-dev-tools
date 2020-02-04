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

namespace CoiSA\DevTools\Faker\Util;

use CoiSA\DevTools\Faker\Factory;
use Faker\Generator;

/**
 * Trait GetFakerTrait
 *
 * @package CoiSA\DevTools\Faker\Util
 */
trait GetFakerTrait
{
    /**
     * @var Generator
     */
    private $faker;

    /**
     * @return Generator
     */
    private function getFaker(): Generator
    {
        if (!$this->faker) {
            $this->faker = Factory::create();
        }

        return $this->faker;
    }
}
