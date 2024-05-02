<?php

namespace App\Controllers;

class DashboardController
{
     public function __construct()
     {
          auth();
     }
     public function index()
     {
          require view('dashboard');
     }
}
