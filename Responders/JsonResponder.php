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

namespace Morvan\Bundle\RespondersBundle\Responders;

use Morvan\Bundle\RespondersBundle\Exceptions\TypeDatasNotAllowedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class JsonResponder
 *
 * This responder return a json response.
 */
class JsonResponder
{
    const LIST_TYPE_ALLOWED = ['string', 'array', 'object', 'NULL'];

    /** @var SerializerInterface */
    protected $serializer;

    /**
     * JsonResponder constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param null  $datas Datas allowed: string, object or array.
     * @param int   $statusCode
     * @param array $additionalHeaders Eventual additionnal headers
     * @param array $contextSerializer If datas is object, context related serializer can be added
     *
     * @return Response
     *
     * @throws TypeDatasNotAllowedException
     */
    public function __invoke(
        $datas = null,
        int $statusCode = Response::HTTP_OK,
        array $additionalHeaders = [],
        array $contextSerializer = []
    ): Response {
        $resultDatas = null;
        if (!in_array(gettype($datas), self::LIST_TYPE_ALLOWED)) {
            throw new TypeDatasNotAllowedException(
                sprintf("Type '%s' for datas not allowed. Only 'string', 'array', 'object' or 'null' value are allowed", gettype($datas))
            );
        }

        switch (gettype($datas)) {
            case 'string':
                $resultDatas = $datas;
                break;
            case 'array':
                $resultDatas = json_encode($datas);
                break;
            case 'object':
                $resultDatas = $this->serializer->serialize($datas, 'json', $contextSerializer);
                break;
        }

        return new Response(
            $resultDatas,
            $statusCode,
            array_merge(
                [
                    'Content-Type' => 'application/json',
                ],
                $additionalHeaders
            )
        );
    }
}
