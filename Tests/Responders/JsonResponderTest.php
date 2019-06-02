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

use Morvan\Bundle\RespondersBundle\Exceptions\TypeDatasNotAllowedException;
use Morvan\Bundle\RespondersBundle\Responders\JsonResponder;
use Morvan\Bundle\RespondersBundle\Tests\TestObject\OutputTest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class JsonResponderTest
 */
class JsonResponderTest extends TestCase
{
    /** @var JsonResponder */
    protected $responder;

    public function testInstanciate()
    {
        static::assertInstanceOf(JsonResponder::class, $this->responder);
        static::assertClassHasAttribute('serializer', get_class($this->responder));
    }

    /**
     * @throws TypeDatasNotAllowedException
     */
    public function testReturnStringDatas()
    {
        $responder = $this->responder;
        $datas = '{"message": "test"}';

        $response = $responder($datas);
        static::assertEquals('application/json', $response->headers->get('Content-Type'));
        static::assertEquals(
            '{"message": "test"}',
            $response->getContent()
        );
    }

    /**
     * @throws TypeDatasNotAllowedException
     */
    public function testTypeNotAllowedException()
    {
        $responder = $this->responder;
        $datas = 3.14;
        static::expectException(TypeDatasNotAllowedException::class);
        static::expectExceptionMessage("Type 'double' for datas not allowed. Only 'string', 'array', 'object'");
        $responder($datas);
    }

    public function testReturnArrayDatas()
    {
        $responder = $this->responder;
        $datas = ['code' => 400, 'message' => 'error'];
        $response = $responder($datas, 400);
        static::assertEquals(400, $response->getStatusCode());
    }

    /**
     * @throws TypeDatasNotAllowedException
     */
    public function testReturnFromObjectDatas()
    {
        $responder = $this->responder;
        $datas = new OutputTest(1, 'Test Object');
        $response = $responder($datas);
        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('{"id": 1, "name": "Test Object"}', $response->getContent());
    }

    protected function setUp(): void
    {
        $mockSerializer = $this->createMock(SerializerInterface::class);
        $mockSerializer->method('serialize')
                       ->willReturn('{"id": 1, "name": "Test Object"}');
        $this->responder = new JsonResponder($mockSerializer);
    }
}
