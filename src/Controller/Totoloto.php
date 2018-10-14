<?php

/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 27-09-2018
 * Time: 9:51
 */

namespace App\Controller;


use App\Services\TotolotoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Totoloto extends AbstractController
{
    /**
     * @var TotolotoService
     */
    private $service;

    /**
     * Totoloto constructor.
     * @param TotolotoService $service
     */
    public function __construct(TotolotoService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/totoloto/{size}")
     */
    public function bet(int $size = 6): Response
    {
        $bet = $this->service->bet($size);

        return $this->render(
            'totoloto/numbers.html.twig',
             compact('bet', 'size')
        );
    }
}
