<?php
require_once 'app/models/BookModel.php';

class BookController
{
    private $model;

    public function __construct()
    {
        $this->model = new BookModel();
    }

    public function listBooks()
    {
        $books = $this->model->getAllBooks();
        include 'app/views/listBooks.php';
    }

    public function createBook()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $published_year = $_POST['published_year'];
            $this->model->createBook($title, $author, $published_year);
            header('Location: index.php');
        } else {
            include 'app/views/createBook.php';
        }
    }

    public function editBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $published_year = $_POST['published_year'];
            $this->model->updateBook($id, $title, $author, $published_year);
            header('Location: index.php');
        } else {
            $book = $this->model->getBookById($id);
            include 'app/views/editBook.php';
        }
    }

    public function deleteBook($id)
    {
        $this->model->deleteBook($id);
        header('Location: index.php');
    }
}
