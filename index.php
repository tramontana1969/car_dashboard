<?php

require_once __DIR__ . '/controller/Controller.php';

$controller = new Controller();

if (isset($_GET['order_by']) && $_GET['order_by'] === 'year') {
    $controller->get('year');
} else {
    $controller->get('-year');
}