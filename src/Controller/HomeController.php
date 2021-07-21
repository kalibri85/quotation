<?php

namespace App\Controller;

use App\Form\CheckTotalPremiumType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $form = $this->getSearchForm();

        return $this->render(
            'home/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    protected function getSearchForm()
    {
        return $this->createForm(
            CheckTotalPremiumType::class,
            null,
            [
                'method' => 'GET'
            ]
        );
    }
}
