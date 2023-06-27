<?php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('product/list.html.twig');
    }

    #[Route('/api/product/listproducts', name: 'api_product_list', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route('/api/product/listproducts/{page}', name: 'api_product_list_paginated', methods: ['GET'])]
    public function apiList(int $page, ProductRepository $products): JsonResponse
    {
        $paginator = $products->getAllPaginated($page);
        return $this->json($paginator);
    }
}
