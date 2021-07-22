<?php

namespace App\Controller;

use App\Form\CheckTotalPremiumType;
use App\Repository\AgeRatingRepository;
use App\Repository\PostcodeRepository;
use App\Repository\AbiCodeRepository;
use App\Http\AbiApp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class HomeController extends AbstractController
{
    const BASE_PREMIUM = 500; 
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
    public function searchAction(Request $request, AgeRatingRepository $ageRaitingRepository, PostcodeRepository $postcodeRepository, AbiCodeRepository $abiCodeRepository)
    {
        $form = $this->getSearchForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dat = $form->getData();
            
            $ageRaiting = $ageRaitingRepository->findOneByAge($form->getData());
            $postcodeRaiting = $postcodeRepository->findOneByPostcodeArea($form->getData());
            $abiRaiting = $abiCodeRepository->findOneByAbiCode(AbiApp::getAbiResponse($dat['regNo']));
            $total = $this->getTotalPremium(
                self::BASE_PREMIUM, 
                is_null($ageRaiting) ? 1 : $ageRaiting -> getRatingFactor(), 
                is_null($postcodeRaiting) ? 1 : $postcodeRaiting -> getRatingFactor(), 
                is_null($abiRaiting) ? 1 : $abiRaiting -> getRatingFactor()
            );
            echo $total;
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

    protected function getTotalPremium($base, $a, $p, $ab) {
        return $base * $a + $base * $p + $base * $ab;
    }
}
