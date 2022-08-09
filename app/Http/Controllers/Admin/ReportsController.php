<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MakeTotalReport;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function total()
    {
        return view('admin.reports.total');
    }

    public function queue()
    {
        $sections = request('sections');

        MakeTotalReport::dispatch(auth()->user(), $sections)->onQueue('reports');

        return redirect(route('admin.reports.index'));
    }
}
