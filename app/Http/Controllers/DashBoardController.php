<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class DashBoardController
 */
class DashBoardController extends Controller
{
    /**
     * Return dashboard view
     *
     * @return \Illuminate\Support\Facades\View
     *
     */
    public function index()
    {
        return view('dashboard');
    }
}
