<?php

require_once __DIR__ . '/../connection/Connection.php';

class Model
{
    public object $connection;
    public static object $db;

    public function __construct()
    {
        $this->connection = new Connection();
        self::$db = $this->connection->connectToDatabase();
    }

    private function sendQuery(string $query): object
    {
        return self::$db->query($query);
    }

    public function getYearSales(): array
    {
        $query = "SELECT AVG(price) as average FROM Showroom_cars WHERE sign = 'sold';";
        $data = $this->sendQuery($query);

        return $data->fetch();
    }

    public function getTodaySales(): array
    {
        $today = date("Y-m-d");
        $query = "SELECT AVG(price) as average FROM Showroom_cars WHERE date_of_sale = '$today'; ";
        $data = $this->sendQuery($query);

        return $data->fetch();
    }

    public function getSoldCars(): array
    {
        $last_year = date("Y-m-d", strtotime("-1 year"));
        $query = "SELECT date_of_sale as date, COUNT(vehicle_id) as cars 
                  FROM Showroom_cars WHERE date_of_sale IS NOT NULL 
                  AND date_of_sale > '$last_year' GROUP BY date_of_sale;";
        $data = $this->sendQuery($query);

        return $data->fetchAll();
    }

    public function getUnsoldCars($order): array
    {
        $query = "SELECT Vehicle_drectory.model as model, Vehicle_drectory.year_of_production as year,
                  Showroom_cars.color as color, Showroom_cars.price as price FROM Vehicle_drectory 
                  JOIN Showroom_cars ON Vehicle_drectory.id = Showroom_cars.vehicle_id
                  WHERE Showroom_cars.sign = 'not sold' ORDER BY $order;";
        $data = $this->sendQuery($query);

        return $data->fetchAll();
    }

    public function getCarsOnSale(): array
    {
        $query = "SELECT model as model, COUNT(model) as quantity 
                  FROM Vehicle_drectory JOIN Showroom_cars ON Vehicle_drectory.id = Showroom_cars.vehicle_id
                  WHERE Showroom_cars.sign = 'not sold' GROUP BY model;";
        $data = $this->sendQuery($query);

        return $data->fetchAll();
    }
}
