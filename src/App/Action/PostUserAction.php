<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 23/08/16
 * Time: 21:55
 */

namespace App\Action;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class PostUserAction
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = $request->getParsedBody();

        if (!$this->validate($data)) {
            return new JsonResponse('', 400);
        }

        try {
            $user = new User($data['username'], $data['email']);

            $this->em->persist($user);
            $this->em->flush();
        }catch (\Exception $e) {
            throw new \InvalidArgumentException($e->getMessage(), 400);
        }

        return new JsonResponse([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        ]);
    }

    /**
     * Better use some validation library :-P
     *
     * @param array $data
     * @return bool
     */
    protected function validate(array $data)
    {
        if (
            !array_key_exists('username', $data) ||
            !array_key_exists('email', $data)
        ) {
            return false;
        }

        return true;
    }
}