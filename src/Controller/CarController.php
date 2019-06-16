<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Model;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     * @param int $id
     * @return Response
     */
    public function editCar(int $id) : Response
    {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        $models = $this->getDoctrine()->getRepository(Model::class)->findAll();

        return $this->render('edit.html.twig', ['car' => $car, 'models' => $models]);
    }

    /**
     * @Route("/getCarData", name="getCarData", methods={"POST"})
     *
     * @return Response
     */
    public function getCarData(Request $request) : Response
    {
        if (isset($_POST['edit'])){
            $car = $this->getDoctrine()->getRepository(Car::class)->find($request->get('edit'));
            $this->addFlash('edit', 'Car was edit!');
        } else {
            $car = new Car();
            $this->addFlash('create', 'Car was created!');
        }

        $car->setGeneration($_POST['generation']);
        $car->setEngine($_POST['engine']);

        $date = DateTime::createFromFormat('Y-m-d', $_POST['date']);
        $car->setYear($date);
        $car->setDrive($_POST['drive']);
        $car->setImage($_POST['image']);
        $car->setColor($_POST['color']);
        $car->setBox($_POST['box']);
        $car->setCost($_POST['cost']);
        $car->setVolume((int)$_POST['volume']);
        $car->setModel($this->getDoctrine()->getRepository(Model::class)->findOneBy(['title' => $_POST['model']]));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($car);
        $entityManager->flush();


        return $this->redirectToRoute('main', ['cars' => $this->getDoctrine()->getRepository(Car::class)->findAll()]);
    }

    /**
     * @Route("/new", name="new")
     *
     * @return Response
     */
    public function new(Request $request) : Response
    {
        $models = $this->getDoctrine()->getRepository(Model::class)->findAll();

        return $this->render('new.html.twig', ['models' => $models]);
    }
}