<?php
session_start();

require_once __DIR__ . '/controller/StudentController.php';

$action = $_GET['action'] ?? 'list';
$controller = new StudentController();

switch ($action) {
    case 'list':
        $controller->list();
        break;
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->list();
}
