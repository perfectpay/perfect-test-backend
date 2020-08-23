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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
