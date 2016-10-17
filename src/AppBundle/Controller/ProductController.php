<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\ControllerTrait as FOSRestTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;


class ProductController extends Controller
{

    use FOSRestTrait;

    /**
     * @Rest\View()
     * @Rest\Get("/products")
     */
    public function getProductsAction()
    {
        $users = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Product')
            ->findAll();
        return $users;

    }

    /**
     * @Rest\View(serializerGroups={"product"})
     * @Rest\Get("/products/{id}")
     */
    public function getProductAction(Request $request)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Product')
            ->find($request->get('id'));

        if (empty($user)) {
            return $this->productNotFound();
        }
        return $user;
    }


    private function productNotFound()
    {
        return $this->view(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
    }
}
