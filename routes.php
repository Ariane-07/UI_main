<?php

session_start();
include('api/config/class.php');

$db = new global_class();


// Redirect to LogReg if no session is set
if (empty($_SESSION)) {
    // Ensure 'page' is the first GET parameter
    $_GET = ['page' => 'LogReg'] + $_GET;
}else{
    
    $UserID=$_SESSION['UserID'];
    $session_data = $db->check_account($UserID);
    $_SESSION['username']=$session_data[0]['Username'];
    $_SESSION['Role']=$session_data[0]['Role'];
}

// Autoload components and pages
function loadComponent($component)
{
    $path = __DIR__ . "/components/{$component}.php";
    if (file_exists($path)) {
        include $path;
    }
}

function loadPage($folder, $page)
{
    $path = __DIR__ . "/{$folder}/{$page}.php";

    // Load the page if it exists, otherwise load Home as default
    if (file_exists($path)) {
        include $path;
    } else {
        include __DIR__ . '/pages/Home.php'; // Default to Home if page is not found
    }
}

// Get 'page', 'vetpage', and 'lgupage' parameters if they exist
$page = $_GET['page'] ?? 'LogReg';         // Default to 'home' if 'page' is not set
$vetpage = $_GET['vetpage'] ?? null;     // Check if 'vetpage' is set
$lgupage = $_GET['lgupage'] ?? null;     // Check if 'lgupage' is set
$component = $_GET['component'] ?? null;

// Include the appropriate Navbar component
if ($vetpage) {
    loadComponent('VetNavbar');          // Load VetNavbar for vet pages
} elseif ($lgupage) {
    loadComponent('LGUNavbar');          // Load LGUNavbar for LGU pages
} elseif ($page !== 'LogReg') {
    loadComponent('Navbar');             // Load default Navbar if it's not the login page
}
// Always load the Floating component unless it's the login page
if ($page !== 'LogReg') {
    loadComponent('Floating');
}



// Determine which page to load
if ($component) {
    loadComponent(ucfirst($component)); 
} elseif ($vetpage) {
    loadPage('vetpages', $vetpage);
} elseif ($lgupage) {
    loadPage('lgupages', $lgupage);
} else {
    loadPage('pages', ucfirst($page)); 
}
