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

namespace Morvan\Bundle\RespondersBundle\Tests\Responders;

use Morvan\Bundle\RespondersBundle\Responders\RedirectResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class RedirectResponderTest
 */
class RedirectResponderTest extends TestCase
{
    /** @var RedirectResponder */
    protected $responder;

    /**
     * Test instanciate RedirectResponder
     */
    public function testInstanciate()
    {
        static::assertInstanceOf(RedirectResponder::class, $this->responder);
        static::assertClassHasAttribute('urlGenerator', get_class($this->responder));
    }

    /**
     * Test object RedirectResponse and default status code 302
     */
    public function testAssertRedirectResponseAndDefaultStatusCode()
    {
        $responder = $this->responder;
        static::assertInstanceOf(RedirectResponse::class, $responder('home'));
        static::assertEquals(302, $responder('home')->getStatusCode());
    }

    protected function setUp(): void
    {
        $mockUrlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $mockUrlGenerator->method('generate')
                         ->willReturn('/');
        $this->responder = new RedirectResponder($mockUrlGenerator);
    }
}
