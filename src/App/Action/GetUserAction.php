<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 23/08/16
 * Time: 22:34
 */

namespace App\Action;


use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Stratigility\Http\ResponseInterface;

class GetUserAction
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $users = [];
        foreach ($this->em->getRepository(User::class)->findAll() as $user) {
            $users[] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail()
            ];
        }


//        var_dump($users);die();

        return new JsonResponse($users);
    }

}