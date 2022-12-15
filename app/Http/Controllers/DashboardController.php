<?php

namespace App\Http\Controllers;
use App\Models\School;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
       dd("dashboard ");
    }


}
