<?php

namespace Bckp\RoadRunner\Middlewares;

use Bckp\RoadRunner\Http\IRequest;
use Bckp\RoadRunner\Http\IResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NetteInitializeMiddleware implements MiddlewareInterface
{
	public function __construct(
		private IRequest $httpRequest,
		private IResponse $httpResponse,
	) {
	}

	public function process(
		ServerRequestInterface $request,
		RequestHandlerInterface $handler,
	): ResponseInterface {
		$this->httpResponse->cleanup();
		$this->httpRequest->updateFromPsr($request);

		return $handler->handle($request);
	}
}
