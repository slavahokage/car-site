<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Car;
use App\Entity\Manufacturer;
use App\Entity\Model;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190616232118 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $entityManager = $this->container->get('doctrine.orm.entity_manager');

        $bmw = new Manufacturer();
        $audi = new Manufacturer();
        $mercedes = new Manufacturer();

        $i8 = new Model();

        $r8 = new Model();

        $amg = new Model();

        $car1 = new Car();

        $car1->setBox('mechanical');
        $car1->setColor('black');
        $car1->setDrive('full');
        $car1->setEngine('petrol');
        $car1->setGeneration('second');
        $car1->setVolume(1395);
        $car1->setCost(1000000);
        $car1->setImage("https://avto.abw.by/images/uploaded_photos/cars/74/49/11777449/11777449_5.jpg?v=1559914362");
        $car1->setYear(new \DateTime());

        $car2 = new Car();

        $car2->setBox('mechanical');
        $car2->setColor('red');
        $car2->setDrive('full');
        $car2->setEngine('petrol');
        $car2->setGeneration('second');
        $car2->setVolume(1400);
        $car2->setCost(10000000);
        $car2->setImage('https://cdn.vdmsti.ru/image/2016/92/xxb3u/default-17yt.jpg');
        $car2->setYear(new \DateTime());

        $car3 = new Car();

        $car3->setBox('mechanical');
        $car3->setColor('white');
        $car3->setDrive('full');
        $car3->setEngine('petrol');
        $car3->setGeneration('first');
        $car3->setVolume(1000);
        $car3->setCost(15000000);
        $car3->setImage('https://www.mbusa.com/content/dam/mb-nafta/us/myco/my19/c/coupe/byo/options/2019-C-CLASS-AMG-COUPE-MODEL-PAGE-032.jpg');
        $car3->setYear(new \DateTime());


        $i8->setTitle('i8');
        $i8->addCar($car1);
        $r8->setTitle('r8');
        $r8->addCar($car2);
        $amg->setTitle('amg');
        $amg->addCar($car3);

        $bmw->addModel($i8);
        $bmw->setTitle('bmw');

        $audi->addModel($r8);
        $audi->setTitle('audi');

        $mercedes->addModel($amg);
        $mercedes->setTitle('amg');

        $entityManager->persist($bmw);
        $entityManager->persist($mercedes);
        $entityManager->persist($audi);

        $entityManager->flush();
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
