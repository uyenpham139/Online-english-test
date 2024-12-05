<?php
    declare(strict_types = 1);
    include 'include/pagecontroller-autoLoad.inc.php';

    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if (strpos($url, 'admin') !== false) {
        $page = new Admin();
        $page->index();
    }
    else if (strpos($url, 'login') !== false) {
        $page = new Login();
        $page->index();
    }
    else if (strpos($url, 'register') !== false) {
        $page = new Register();
        $page->index();
    }
    else if (strpos($url, 'home') !== false) {
        $page = new Home();
        $page->index();
    }
    else if (strpos($url, 'contact') !== false) {
        $page = new Contact();
        $page->index();
    }
    else {
        $page = new Home();
        $page->index();
    }
?>

