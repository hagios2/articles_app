<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\Type\CustomerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends AbstractApiController
{
    public function index(): Response
    {
        $orders = $this->getDoctrine()->getRepository(Customer::class)->findAll();

        return $this->json($orders, 200);
    }

    public function create(Request $request): Response
    {
        $form = $this->buildForm(CustomerType::class);

        $form->handleRequest($request);

        if(!$form->isSubmitted() && !$form->isValid())
        {
           return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var Customer $customer */
        $customer = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($customer);

        $entityManager->flush();

        return $this->respond($customer);

    }
}
