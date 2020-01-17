<?php

/**
 * This file is part of coisa/dev-tools.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/coisa/dev-tools
 * @copyright Copyright (c) 2019 Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace CoiSA\DevTools\Composer\Plugin\Capability;

use CoiSA\DevTools\Composer\Command;
use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;

/**
 * Class CommandProvider
 *
 * @package CoiSA\DevTools\Composer\Plugin\Capability
 */
class CommandProvider implements CommandProviderCapability
{
    /**
     * @return \Composer\Command\BaseCommand[]
     */
    public function getCommands()
    {
        return [
            new Command\AnalyzeCommand(),
            new Command\CsFixCommand(),
            new Command\TestCommand(),
        ];
    }
}
