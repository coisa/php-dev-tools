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

namespace CoiSA\DevTools\PHPUnit\Framework;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class AbstractInvokableFactoryTestCase
 *
 * @package CoiSA\DevTools\PHPUnit\Framework
 */
abstract class AbstractInvokableFactoryTestCase extends TestCase
{
    /**
     * Return a new instance of the factory class that will be tested.
     *
     * @return callable
     */
    abstract public function getFactoryInstance(): callable;

    /**
     * Return an array of dependencies identifier that will be consumed through container get method.
     *
     * @return array[]|mixed[]|string[]
     */
    abstract public function getDependenciesOnContainer(): array;

    /**
     * This method SHOULD return the expected namespace of object that factory will create.
     *
     * @return string
     */
    abstract public function getInvokeReturnType(): string;

    /**
     * @return array
     */
    public function provideDependencyClassNamesFromContainer(): array
    {
        $dependecyInjection = $this->getDependenciesOnContainer();

        $provided = [];
        foreach ($dependecyInjection as $key => $value) {
            $provided[] = [\is_numeric($key) ? $value : $key];
        }

        return $provided;
    }

    public function testInvokeWillReturnInstanceOfTestCaseInvokeReturnType(): void
    {
        $factory   = $this->getFactoryInstance();
        $container = $this->prophesizeContainer();

        $return = ($factory)($container->reveal());

        $this->assertInstanceOf($this->getInvokeReturnType(), $return);
    }

    /**
     * @dataProvider provideDependencyClassNamesFromContainer
     *
     * @param mixed $dependecy
     */
    public function testInvokeWithoutDependecyWillThrowNotFoundException($dependecy): void
    {
        $exception = new class () extends \Exception implements NotFoundExceptionInterface {
        };
        $factory   = $this->getFactoryInstance();
        $container = $this->prophesizeContainer();

        $container->get($dependecy)->willThrow($exception);

        $this->expectException(NotFoundExceptionInterface::class);
        ($factory)($container->reveal());
    }

    /**
     * @dataProvider provideDependencyClassNamesFromContainer
     *
     * @param mixed $dependecy
     */
    public function testInvokeWithInvalidDependencyWillThrowErrorException($dependecy): void
    {
        if (\is_array($dependecy)) {
            $dependecy = \key($dependecy);
        }

        $factory   = $this->getFactoryInstance();
        $container = $this->prophesizeContainer();

        $container->get($dependecy)->willReturn(new \stdClass());

        $this->expectException(\TypeError::class);
        ($factory)($container->reveal());
    }

    /**
     * @return ObjectProphecy
     */
    private function prophesizeContainer(): ObjectProphecy
    {
        $dependecyInjection = $this->getDependenciesOnContainer();
        $container          = $this->prophesize(ContainerInterface::class);

        foreach ($dependecyInjection as $key => $value) {
            $dependecyClassName = \is_numeric($key) ? $value : $key;

            if (\is_string($value)) {
                $dependecy = $this->prophesize($dependecyClassName);
                $container->get($dependecyClassName)->will([$dependecy, 'reveal']);
            } else {
                $container->get($dependecyClassName)->willReturn($value);
            }
        }

        return $container;
    }
}
