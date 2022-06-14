<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/Model.php';

class Controller
{
    public object $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function get($order)
    {
        $year_sales = $this->model->getYearSales();
        $today_sales = $this->model->getTodaySales();
        $sold_cars = $this->model->getSoldCars();
        $unsold_cars = $this->model->getUnsoldCars($order);
        $cars_on_sale = $this->model->getCarsOnSale();
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader);

        echo $twig->render('dashboard.twig', [
            'year_sales' => $year_sales,
            'today_sales' => $today_sales,
            'sold_cars' => $sold_cars,
            'unsold_cars' => $unsold_cars,
            'cars_on_sale' => $cars_on_sale,
        ]);
    }
}