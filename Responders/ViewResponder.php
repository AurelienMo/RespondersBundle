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

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ViewResponder
 *
 * This responder used to return a view calling by an action.
 */
class ViewResponder
{
    /** @var Environment */
    protected $templating;

    /**
     * ViewResponder constructor.
     *
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    /**
     * @param string $template
     * @param array  $paramsTemplate
     *
     * @param int    $statusCode
     *
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(
        string $template,
        array $paramsTemplate = [],
        int $statusCode = Response::HTTP_OK
    ): Response {
        return new Response(
            $this->templating->render($template, $paramsTemplate),
            $statusCode
        );
    }
}
