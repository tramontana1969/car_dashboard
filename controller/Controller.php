<?php

require_once __DIR__ . '/../model/Model.php';

class Controller
{
    public object $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function get()
    {
        $year_sales = $this->model->getYearSales();
        $today_sales = $this->model->getTodaySales();
        $sold_cars = $this->model->getSoldCars();
        $unsold_cars = $this->model->getUnsoldCars();
        $cars_on_sale = $this->model->getCarsOnSale();
        require_once __DIR__ . '/../view/dashboard.php';
    }
}