<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{


    public function index()
    {
        $widgets = collect([
            [

                'title' => 'Total Organizer',
                'count' => 100,
                'icon' => 'ion ion-ios-people-outline',
                'color' => 'bg-green'
            ]
        ]);
        return view('backend.dashboard', compact('widgets'));
    }

}
