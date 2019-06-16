<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Manufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function main() : Response
    {
        $cars = $this->getDoctrine()->getRepository(Car::class)->findAll();

        return $this->render('main.html.twig', ['cars' => $cars]);
    }
}