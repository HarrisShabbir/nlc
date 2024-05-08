<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){

        $pageData = [
            'pageTitle' => 'Dashboard',
        ];

        return view('dashboard', compact('pageData'));

    }
}
