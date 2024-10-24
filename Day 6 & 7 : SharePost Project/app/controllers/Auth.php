<?php

class Auth extends Controller
{
    private $userModel;
    public function __construct()
    {
        // Load User model
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proceess Form
            // Initialize form data
            $data = [
                'title' => 'SharePost',
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'nameError' => '',
                'emailError' => '',
                'passwordError' => '',
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['nameError'] = 'Name is required..!';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email is required..!';
            } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $data['email'])) {
                $data['emailError'] = 'Invalid email..!';
            } else {
                // Check email in database
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email already exists..!';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Password is required..!';
            } else if (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password must be atleast 6 characters..!';
            }

            if (empty($data['nameError']) && empty($data['emailError']) && empty($data['passwordError'])) {
                // Validated
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                if ($this->userModel->register($data)) {
                    flashMessage('register_success', 'Registration Successful! You can now log in.', 'alert alert-success text-center');
                    redirect('auth/login');
                } else {
                    die("Something went wrong..!");
                }
            } else {
                // Load the View with errors
                $this->view('auth/register', $data);
            }
        } else {
            // Initialize data
            $data = [
                'title' => 'SharePost',
                'name' => '',
                'email' => '',
                'password' => '',
                'nameError' => '',
                'emailError' => '',
                'passwordError' => '',
            ];

            // Load the View
            $this->view('auth/register', $data);
        }
    }

    public function login()
    {
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proceess Form
            // Initialize form data
            $data = [
                'title' => 'SharePost',
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => '',
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email is required..!';
            } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $data['email'])) {
                $data['emailError'] = 'Invalid email..!';
            } else {
                // Check for user/email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    // User found
                } else {
                    $data['emailError'] = 'No user found..!';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Password is required..!';
            }



            if (empty($data['emailError']) && empty($data['passwordError'])) {
                // Validated

                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create user session
                    $this->createUserSession($loggedInUser);
                    die("Success");
                } else {
                    // If login fails, set error
                    $data['passwordError'] = 'Password incorrect..!';
                    $this->view('auth/login', $data);
                }
            } else {
                // Load the View with error
                $this->view('auth/login', $data);
            }
        } else {
            // Initialize data
            $data = [
                'title' => 'SharePost',
                'name' => '',
                'email' => '',
                'password' => '',
                'nameError' => '',
                'emailError' => '',
                'passwordError' => '',
            ];

            $this->view('auth/login', $data);
        }
    }

    // Logout User
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        session_destroy(); // To destroy all session


        // Redirect to the homepage or dashboard
        redirect('pages/index'); // Change 'pages/index' to your desired location

    }

    // Create user session
    public function createUserSession($user)
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Store user data in session variables
        $_SESSION['user_id'] = $user->id; // Assuming $user has an 'id' property
        $_SESSION['user_email'] = $user->email; // Assuming $user has an 'email' property
        $_SESSION['user_name'] = $user->name; // Assuming $user has a 'name' property

        // Redirect to the homepage or dashboard
        redirect('posts/index'); // Change 'pages/index' to your desired location
    }

}
