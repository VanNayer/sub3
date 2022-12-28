<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanTemplateController extends AbstractController
{
    #[Route('/plan/template', name: 'app_plan_template')]
    public function index(): Response
    {
        return $this->render('plan_template/index.html.twig', [
            'controller_name' => 'PlanTemplateController',
        ]);
    }
}
