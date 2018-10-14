<?php
/**
 * Created by PhpStorm.
 * User: vasco
 * Date: 12-10-2018
 * Time: 18:12
 */

namespace App\Controller;


use App\Services\EuromillionsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Euromillions extends AbstractController
{//serviço depende do controlador dependencia

    public function __construct(EuromillionsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param int $size
     * @param int $stars
     * @Route("/euromillions/{size}/{stars}")
     */
    public function bet(int $size = 5, int $stars = 2)
    {
        $bet = $this->service->bet($size, $stars);

        return $this->render('euromillions/numbers.html.twig',
            compact('bet','stars','size'));
    }

}