<?php

declare(strict_types=1);

/*
 * This file is part of MorvanRespondersBundle
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DependencyInjection;

use Morvan\Bundle\RespondersBundle\DependencyInjection\MorvanRespondersExtension;
use Morvan\Bundle\RespondersBundle\Responders\ViewResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MorvanRespondersExtensionTest
 */
class MorvanRespondersExtensionTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    public function testContainerHasService()
    {
        static::assertTrue($this->container->hasExtension('morvan_responders'));
    }

    public function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->container->registerExtension(new MorvanRespondersExtension());
        $this->container->loadFromExtension('morvan_responders', []);

        $this->container->compile();
    }
}
