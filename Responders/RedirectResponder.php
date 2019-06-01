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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class RedirectResponder
 *
 * Response to return a redirect response for given parameters
 */
class RedirectResponder
{
    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /**
     * RedirectResponder constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param string $routeName
     * @param array  $paramsRoute
     * @param int    $statusCode
     *
     * @return RedirectResponse
     */
    public function __invoke(
        string $routeName,
        array $paramsRoute = [],
        int $statusCode = Response::HTTP_FOUND
    ): RedirectResponse {
        return new RedirectResponse(
            $this->urlGenerator->generate($routeName, $paramsRoute),
            $statusCode
        );
    }
}
