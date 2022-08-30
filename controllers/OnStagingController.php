<?php

namespace PHPMaker2022\opsmezzanineupload;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * OnStaging controller
 */
class OnStagingController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "OnStagingSummary");
    }
}
