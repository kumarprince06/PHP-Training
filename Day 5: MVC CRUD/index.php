<?php
require_once 'app/controllers/BookController.php';

$controller = new BookController();

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'create':
        $controller->createBook();
        break;
    case 'edit':
        if ($id) {
            $controller->editBook($id);
        } else {
            echo "Book ID is missing.";
        }
        break;
    case 'delete':
        if ($id) {
            $controller->deleteBook($id);
        } else {
            echo "Book ID is missing.";
        }
        break;
    default:
        $controller->listBooks();
}
