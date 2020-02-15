<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $entitiesPerCategory = new LaravelChart([
            'chart_title' => 'Entities per category',
            'model' => Entity::class,
            'report_type' => 'group_by_relationship',
            'relationship_name' => 'category',
            'group_by_field' => 'name',
            'chart_type' => 'pie',
        ]);

        $usersPerType = new LaravelChart([
            'chart_title' => 'Users per type',
            'report_type' => 'group_by_string',
            'model' => User::class,
            'group_by_field' => 'role',
            'chart_type' => 'pie',
        ]);

        return view('admin.index', compact('entitiesPerCategory', 'usersPerType'));

    }
}
