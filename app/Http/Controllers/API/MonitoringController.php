<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Monitoring;

class MonitoringController extends Controller
{
    public function index()
    {
        return Monitoring::all()->toJson();
    }
}
