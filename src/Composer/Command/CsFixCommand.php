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
    /**
     * @var string Command name
     */
    protected static $defaultName = 'cs-fix';

    /**
     * Fix code styles
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @TODO Use this repo configurations if the working-dir doesnt have specific configurations
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        // @FIXME find binary directory when executed by a global installation
        $directory = \getcwd();
        $helper    = $this->getHelper('process');

        $helper->run($output, \explode(' ', \sprintf('%s/vendor/bin/php-cs-fixer %s', $directory, 'fix')));
        $helper->run($output, \explode(' ', \sprintf('%s/vendor/bin/phpcbf', $directory)));
    }
}
