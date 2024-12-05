<?php

class Staff {
    public function index() {
        session_start();
        require_once 'FE/staff.php';
    }
}