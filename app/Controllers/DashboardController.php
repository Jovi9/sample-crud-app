<?php

namespace App\Controllers;

class DashboardController
{
     public function __construct()
     {
          auth();
     }
     public function index($request)
     {
          requestChecker($request, route('dashboard'));
          require view('dashboard');
     }
}
