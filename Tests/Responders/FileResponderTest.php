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

use Morvan\Bundle\RespondersBundle\Responders\FileResponder;
use PHPStan\Testing\TestCase;

class FileResponderTest extends TestCase
{
    protected $responder;

    public function testInstanciate()
    {
        static::assertInstanceOf(FileResponder::class, $this->responder);
    }

    public function setUp(): void
    {
        $this->responder = new FileResponder();
    }
}
