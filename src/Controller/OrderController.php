<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\Type\OrderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractApiController
{

    public function index(): Response
    {
        $orders = $this->getDoctrine()->getRepository(Order::class)->findAll();

        return $this->json($orders, 200);
    }

    public function create(Request $request): Response
    {
        $form = $this->buildForm(OrderType::class);

        $form->handleRequest($request);

        if(!$form->isSubmitted() && !$form->isValid())
        {
            print('Error occurred');

            exit;
        }

        $customer = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($customer);

        $entityManager->flush();

        return $this->json(['message' => 'customer saved'], 200);
    }
}
