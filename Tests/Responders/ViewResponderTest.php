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

namespace Tests\Responders;

use Morvan\Bundle\RespondersBundle\Responders\ViewResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ViewResponderTest
 */
class ViewResponderTest extends TestCase
{
    /** @var ViewResponder */
    protected $responder;

    /**
     * Test instanciate View Responder
     */
    public function testInstanciate()
    {
        static::assertInstanceOf(ViewResponder::class, $this->responder);
        static::assertClassHasAttribute('templating', get_class($this->responder));
    }

    /**
     * Test object Response and default status code 200
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function testAssertResponseAndDefaultStatusCode()
    {
        $responder = $this->responder;
        static::assertInstanceOf(Response::class, $responder('test.html.twig'));
        static::assertEquals(200, $responder('test.html.twig')->getStatusCode());
    }

    protected function setUp(): void
    {
        $mockEnvironment = $this->createMock(Environment::class);
        $this->responder = new ViewResponder($mockEnvironment);
    }
}
