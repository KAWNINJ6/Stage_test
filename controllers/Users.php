<?php
require_once('../models/User.php');

class Users 
{
    private $userModel; // Instance of User class

    public function __construct() 
    {
        $this->userModel = new User();
    }

    public function register()
    {
        // Get the data from the form
        $_POST = filter_input_array(INPUT_POST);

        //Init data
        $date = trim($_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']);

        // Init data
        $data = [
            'firstName' => trim($_POST['firstname']),
            'lastName' => trim($_POST['lastname']),
            'login' => trim($_POST['login']),
            'password' => trim($_POST['password']),
            'birthday' => $date,
            'gender' => trim($_POST['gender'])
        ];

        // Send hashed password for security 
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 

        //Register User
        if($this->userModel->createUser($data)) {
            // Only for demonstration purposes.
            $message = "Utilisateur créé avec succès";
            echo "<script type='text/javascript'>alert('$message');</script>";
            // Only for demonstration purposes.
            // header('location: ./views/*.php'); ---> redirect to the home page
        } else {
            die("Something went wrong");
        }
    }

    public function login()
    {
        // Get the data from the form
        $_POST = filter_input_array(INPUT_POST);

        // Init data
        $data = [
            'login' => trim($_POST['login']),
            'password' => trim($_POST['password'])
        ];

        //Check for user/email
        if($this->userModel->findUserByLogin($data['login'])) {
            //User Found
            $loggedInUser = $this->userModel->findUserByLoginAndPassword($data['login'], $data['password']);
            if($loggedInUser) {
                // Only for demonstration purposes.
                $message = "Utilisateur connecté avec succès";
                echo "<script type='text/javascript'>alert('$message');</script>";
                // Only for demonstration purposes.

                // $this->createUserSession($loggedInUser); ---> Create a user session
            } else {
                // Password incorrect
                header("Location: ..");
            }
        } else {
            // User not found
            header("Location: ..");
        }
    }

    // Create a user session
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_login'] = $user->login;
        $_SESSION['user_firstName'] = $user->firstName;
        $message = "Utilisateur connecté avec succès";
        echo "<script type='text/javascript'>alert('$message');</script>";
        // header('location: ./views/*.php'); ---> redirect to the home page
    }
}

$init = new Users; // Instance of Users class

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    switch($_POST['type'])
    {
        case 'register':
            $init->register();
            break;
        
        case 'login':
            $init->login();
            break;
        
        default:
            echo 'Erreur';
            break;
    }
}