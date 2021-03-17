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

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FileResponder
{
    /**
     * @param \SplFileObject|string $file
     * @param string|null           $fileName
     * @param string                $disposition
     * @return BinaryFileResponse
     */
    public function __invoke(
        $file,
        ?string $fileName = null,
        string $disposition = ResponseHeaderBag::DISPOSITION_ATTACHMENT
    ): BinaryFileResponse {
        $response = new BinaryFileResponse($file);

        $response->setContentDisposition(
            $disposition,
            $fileName ?? $response->getFile()->getFilename()
        );

        return $response;
    }
}
