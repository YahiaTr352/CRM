<?php

namespace App\Http\Controllers\Admin;

use App\Models\CrmContact;
use App\Models\CrmProduct;
use App\Models\Deal;
use App\Models\Task;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title' => 'Total Contacts',
            'total_number' => CrmContact::count(),
        ];

        $settings2 = [
            'chart_title' => 'Total Deals',
            'total_number' => Deal::count(),
        ];

        $settings_products = [
            'chart_title' => 'Active Products',
            'total_number' => CrmProduct::where('product_active', 1)->count(),
        ];

        $settings_tasks = [
            'chart_title' => 'Pending Tasks',
            'total_number' => Task::whereHas('status', function($q) {
                $q->where('name', '!=', 'Closed');
            })->count(),
        ];

        $settings3 = [
            'chart_title'        => 'Deals by Stage',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Deal',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'month',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'stage',
            'translation_key'    => 'deal',
        ];

        $chart3 = new LaravelChart($settings3);

        $settings4 = [
            'chart_title'    => 'Recent Tasks',
            'entries_number' => '5',
            'data'           => Task::with(['status'])->latest()->take(5)->get(),
        ];

        return view('home', compact('chart3', 'settings1', 'settings2', 'settings_products', 'settings_tasks', 'settings4'));
    }
}
