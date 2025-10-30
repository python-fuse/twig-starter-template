<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader,[
    'cache' => __DIR__ . '/../cache/twig',
    'auto_reload' => true,
]);

// Simple case based router: Add your routes here
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Add cases for different routes and pass variables to the templates as needed
switch($path){
    case '/':
    case '/home':
        // Landing page
        echo $twig->render('landing.html.twig', [
            'title' => "TicketFlow - Home",
        ]);
        break;
        
    case '/login':
        // Handle login form submission
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Simple validation
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            }
            
            if (empty($password)) {
                $errors['password'] = 'Password is required';
            }
            
            if (empty($errors)) {
                // Simple authentication (in a real app, you would check against a database)
                $users = json_decode(file_get_contents(__DIR__ . '/../data/users.json') ?: '[]', true);
                $user = null;
                foreach ($users as $u) {
                    if ($u['email'] === $email && $u['password'] === $password) {
                        $user = $u;
                        break;
                    }
                }
                
                if ($user) {
                    // Create session
                    $_SESSION['ticketapp_session'] = session_id();
                    $_SESSION['currentUser'] = $user;
                    header('Location: /dashboard');
                    exit;
                } else {
                    $errors['general'] = 'Invalid email or password';
                }
            }
        }
        
        echo $twig->render('login.html.twig', [
            'title' => "Login - TicketFlow",
            'errors' => $errors,
            'last_username' => $email ?? ''
        ]);
        break;
        
    case '/signup':
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';
            
            // Validation
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }
            
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Enter a valid email';
            }
            
            // Check if user already exists
            $users = json_decode(file_get_contents(__DIR__ . '/../data/users.json') ?: '[]', true);
            foreach ($users as $u) {
                if ($u['email'] === $email) {
                    $errors['email'] = 'Email is already registered';
                    break;
                }
            }
            
            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }
            
            if (empty($confirmPassword)) {
                $errors['confirmPassword'] = 'Please confirm your password';
            } elseif ($password !== $confirmPassword) {
                $errors['confirmPassword'] = 'Passwords do not match';
            }
            
            if (empty($errors)) {
                // Create new user
                $newUser = [
                    'id' => time(), // Simple ID generation
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'createdAt' => date('c')
                ];
                
                $users[] = $newUser;
                file_put_contents(__DIR__ . '/../data/users.json', json_encode($users, JSON_PRETTY_PRINT));
                
                // Redirect to login with success message
                $_SESSION['flash_message'] = '🎉 Account created successfully! Please log in.';
                $_SESSION['flash_type'] = 'success';
                header('Location: /login');
                exit;
            }
        }
        
        echo $twig->render('signup.html.twig', [
            'title' => "Sign Up - TicketFlow",
            'errors' => $errors,
            'name' => $name ?? '',
            'email' => $email ?? '',
        ]);
        break;
        
    case '/dashboard':
        // Check if user is authenticated
        if (!isset($_SESSION['ticketapp_session']) || !isset($_SESSION['currentUser'])) {
            header('Location: /login');
            exit;
        }
        
        $currentUser = $_SESSION['currentUser'];
        
        // Load tickets
        $tickets = json_decode(file_get_contents(__DIR__ . '/../data/tickets.json') ?: '[]', true);
        
        // Filter tickets for current user
        $userTickets = array_filter($tickets, function($ticket) use ($currentUser) {
            return $ticket['userId'] == $currentUser['id'];
        });
        
        $openTickets = count(array_filter($userTickets, fn($t) => $t['status'] === 'open'));
        $inProgressTickets = count(array_filter($userTickets, fn($t) => $t['status'] === 'in_progress'));
        $closedTickets = count(array_filter($userTickets, fn($t) => $t['status'] === 'closed'));
        
        echo $twig->render('dashboard.html.twig', [
            'title' => "Dashboard - TicketFlow",
            'currentUser' => $currentUser,
            'tickets' => array_values($userTickets),
            'openTickets' => $openTickets,
            'inProgressTickets' => $inProgressTickets,
            'closedTickets' => $closedTickets
        ]);
        break;
        
    case '/tickets':
        // Check if user is authenticated
        if (!isset($_SESSION['ticketapp_session']) || !isset($_SESSION['currentUser'])) {
            header('Location: /login');
            exit;
        }
        
        $currentUser = $_SESSION['currentUser'];
        
        // Load tickets
        $tickets = json_decode(file_get_contents(__DIR__ . '/../data/tickets.json') ?: '[]', true);
        
        // Filter tickets for current user
        $userTickets = array_filter($tickets, function($ticket) use ($currentUser) {
            return $ticket['userId'] == $currentUser['id'];
        });
        
        echo $twig->render('tickets.html.twig', [
            'title' => "Tickets - TicketFlow",
            'tickets' => array_values($userTickets)
        ]);
        break;
        
    case '/logout':
        // Clear session
        session_destroy();
        header('Location: /');
        exit;
        
    default:
        http_response_code(404);
        echo $twig->render('404.html.twig', [
            'title' => "404 Not Found - TicketFlow",
        ]);
        break;
}