<?php

namespace App\Controller;

use App\Service\CalendarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/calendar/{month}', name: 'calendar_row')]
    #[Route('/calendar/{table}/{month}', name: 'calendar_table', requirements: ['table' => 'table'])]
    #[Route('/calendar/{weekend}/{month}', name: 'calendar_weekend', requirements: ['weekend' => 'weekend'])]
    public function index(int $month, ?string $table = null, ?string $weekend = null)
    {
        if ($month < 1 || $month > 12) throw new HttpException(422);

        $data = CalendarService::buildFromMonth($month);

        $view = !is_null($table) ? 'base' : (!is_null($weekend) ? 'weekend' : 'row');
        return $this->render("calendar/{$view}.twig", ['month' => $month, 'calendar' => $data]);
    }
}