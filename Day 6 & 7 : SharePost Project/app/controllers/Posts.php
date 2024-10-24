<?php

class Posts extends Controller
{

    private $postsModel;
    private $userModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }
        $this->userModel = $this->model('User');
        $this->postsModel = $this->model('Post');
    }

    // Index
    public function index()
    {
        $posts = $this->postsModel->getPosts();
        $data = [
            'title' => 'Sharepost',
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    // Add
    public function add()
    {

        // Check Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Initialize form data
            $data = [
                'title' => 'Sharepost',
                'postTitle' => $_POST['postTitle'],
                'body' => $_POST['body'],
                'postTitleError' => '',
                'bodyError' => '',
            ];

            // Validate post title
            if (empty($data['postTitle'])) {
                $data['postTitleError'] = 'Post title required..!';
            }

            // Validatte post body
            if (empty($data['body'])) {
                $data['bodyError'] = 'Post body required..!';
            }


            if (empty($data['postTitleError']) && empty($data['bodyError'])) {
                // process form
                if ($this->postsModel->addPost($data)) {
                    flashMessage('postMessage', 'Post shared successfully', 'alert alert-success text-center');
                    redirect('posts');
                } else {
                    die('Something went wrong..!');
                }
            } else {
                // Load view with error
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => 'Sharepost',
                'postTitle' => '',
                'body' => '',
                'postTitleError' => '',
                'bodyError' => '',
            ];
            $this->view('posts/add', $data);
        }
    }

    // Show
    public function show($id)
    {
        $post = $this->postsModel->getPostById($id);
        $user = $this->userModel->findUserById($post->userId);
        $data = ['title' => 'Sharepost', 'post' => $post, 'user' => $user];
        $this->view('posts/show', $data);
    }

    // Edit / Update
    public function edit($id)
    {
        // Check Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Initialize form data
            $data = [
                'title' => 'Sharepost',
                'id' => $id,
                'postTitle' => $_POST['postTitle'],
                'body' => $_POST['body'],
                'postTitleError' => '',
                'bodyError' => '',
            ];

            // Validate post title
            if (empty($data['postTitle'])) {
                $data['postTitleError'] = 'Post title required..!';
            }

            // Validatte post body
            if (empty($data['body'])) {
                $data['bodyError'] = 'Post body required..!';
            }


            if (empty($data['postTitleError']) && empty($data['bodyError'])) {
                // process form
                if ($this->postsModel->editPost($data)) {
                    flashMessage('postMessage', 'Post updated successfully', 'alert alert-success text-center');
                    redirect('posts');
                } else {
                    die('Something went wrong..!');
                }
            } else {
                // Load view with error
                $this->view('posts/edit', $data);
            }
        } else {

            // Fetch existing post
            $post = $this->postsModel->getPostById($id);
            // Check for owner
            if ($post->userId != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'title' => 'Sharepost',
                'id' => $id,
                'postTitle' => $post->title,
                'body' => $post->body,
                'postTitleError' => '',
                'bodyError' => '',
            ];
            $this->view('posts/edit', $data);
        }
    }

    // Delete Post
    public function delete($id)
    {
        // check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proccess
            // Fetch existing post
            $post = $this->postsModel->getPostById($id);
            // Check for owner
            if ($post->userId != $_SESSION['user_id']) {
                redirect('posts');
            }

            if ($this->postsModel->deletePostById($id)) {
                flashMessage('postMessage', 'Post deleted successfully', 'alert alert-success text-center');
                redirect('posts');
            }
        } else {
            // Redirect to post
            redirect('posts');
        }
    }
}
