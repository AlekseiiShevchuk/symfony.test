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
        $users = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:FOSUser')
            ->findAll();
        return $users;

    }

    /**
     * @Rest\View(serializerGroups={"user"})
     * @Rest\Get("/users/{id}")
     */
    public function getUserAction(Request $request)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:User')
            ->find($request->get('id'));

        if (empty($user)) {
            return $this->userNotFound();
        }
        return $user;
    }


    private function userNotFound()
    {
        return $this->view(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}
