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
        $products = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Product')
            ->findAll();
        return $products;

    }

    /**
     * @Rest\View(serializerGroups={"product"})
     * @Rest\Get("/products/{id}")
     */
    public function getProductAction(Request $request)
    {
        $product = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Product')
            ->find($request->get('id'));

        if (empty($product)) {
            return $this->productNotFound();
        }
        return $product;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/products/{id}")
     */
    public function removeProductAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $product = $em->getRepository('AppBundle:Product')
            ->find($request->get('id'));

        if ($product) {
            $em->remove($product);
            $em->flush();
        }
    }


    private function productNotFound()
    {
        return $this->view(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
    }
}
