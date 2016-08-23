<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 23/08/16
 * Time: 20:11
 */

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HelloAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $query = $request->getQueryParams();
        $target = isset($query['target']) ? $query['target'] : 'World';
        $target = htmlspecialchars($target, ENT_HTML5, 'UTF-8');

        $response->getBody()->write(sprintf(
            '<h1>Hello, %s!</h1>',
            $target
        ));

        return $response->withHeader('Content-Type', 'text/html');
    }
}