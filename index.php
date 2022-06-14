<?php

require_once __DIR__ . '/controller/Controller.php';

$controller = new Controller();

if (isset($_GET['year_order']) && $_GET['year_order'] === 'asc') {
    $controller->get('year');
} else {
    $controller->get('-year');
}