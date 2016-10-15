<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\ControllerTrait as FOSRestTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;


class UserController extends Controller
{

    use FOSRestTrait;

    /**
     * @Rest\View()
     * @Rest\Get("/users")
     */
    public function getUsersAction()
    {
        $users = [
            [
                'name' => 'user1',
                'surname' => 'userSurname1'
            ],
            [
                'name' => 'user2',
                'surname' => 'userSurname2'
            ]
        ];

        return $users;
    }

    /**
     * @Rest\View(serializerGroups={"user"})
     * @Rest\Get("/users/{id}")
     */
    public function getUserAction(Request $request)
    {
        $user = [
            'name' => 'user1',
            'surname' => 'usersurname1'
        ];

        if ($request->get('id') > 1) {
            return $this->userNotFound();
        }

        return $user;
    }


    private function userNotFound()
    {
        return $this->view(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}
