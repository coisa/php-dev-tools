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

namespace CoiSA\DevTools\Composer\Command;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CsFixCommand
 *
 * @package CoiSA\DevTools\Composer\Command
 */
class CsFixCommand extends BaseCommand
{
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->write(self::class);
    }

    protected function configure(): void
    {
        $this->setName('cs-fix');
    }
}
