<?php

namespace App\Controller;

use App\Form\CheckTotalPremiumType;
use App\Repository\AgeRatingRepository;
use App\Repository\PostcodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
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
     /**
     * @Route("/quotation", name="quotation")
     * @Method("GET")
     */
    public function searchAction(Request $request, AgeRatingRepository $ageRaitingRepository, PostcodeRepository $postcodeRepository)
    {
        $form = $this->getSearchForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ageRaiting = $ageRaitingRepository->findOneByAge($form->getData());
            $postcodeRaiting = $postcodeRepository->findOneByPostcodeArea($form->getData());
            var_dump($postcodeRaiting);
        }

        return $this->render(
            'home/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    protected function getSearchForm()
    {
        return $this->createForm(
            CheckTotalPremiumType::class,
            null,
            [
                'method' => 'GET',
                'action' => $this->generateUrl('quotation')
            ]
        );
    }
}
