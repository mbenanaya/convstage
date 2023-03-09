<?php

require_once('./EtudiantController.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

class LoginController {

    public $etudiant;
    public $email;
    public $password;

    // public function __construct($email, $password)
    // {
    //     $this->email = $email;
    //     $this->password = $password;
    // }

    public function handleLogin()
    {
        if (isset($_POST['connecter'])) {
            $this->email = stripcslashes(htmlspecialchars(trim($_POST['email'])));
            $this->password = stripcslashes(htmlspecialchars(trim($_POST['password'])));
            $this->etudiant = new EtudiantController($this->email, $this->password);
            $this->etudiant->authenticate();
        }
    }

    // public function index() {
    //     // If the user is already logged in, redirect him to the special index page
    //     if (isset($_SESSION['user'])) {
    //         $user = $_SESSION['user'];
    //         $this->redirectToIndex($user);
    //     }
        
    //     // If the user submitted the login form, try to authenticate him
    //     if (isset($_POST['email']) && isset($_POST['password'])) {
    //         $email = $_POST['email'];
    //         $password = $_POST['password'];
            
    //         // Create a new User object and try to authenticate the user
    //         $user = new User($email, $password, '');
    //         if ($user->authenticate()) {
    //             // If the user is authenticated, store the user object in the session
    //             $_SESSION['user'] = $user;
    //             $this->redirectToIndex($user);
    //         } else {
    //             // If the user is not authenticated, show an error message
    //             echo "Invalid email or password";
    //         }
    //     }
        
    //     // If the user did not submit the login form, show the login form
    //     require_once 'views/login_form.php';
    // }
    
    // private function redirectToIndex($user) {
    //     // Redirect the user to the special index page according to his type
    //     if ($user->getType() == 'student') {
    //         header('Location: student_index.php?name=' . $user->getEmail());
    //     } else if ($user->getType() == 'admin') {
    //         header('Location: admin_index.php?name=' . $user->getEmail());
    //     }
    //     exit();
    // }
}

$login = new LoginController;
$login->handleLogin();