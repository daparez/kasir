<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class homeController extends Controller
{
    publiC function index()
    {
        $Kategori = Kategori::count();

        return view('pages.admin.dashboard', compact('Kategori'));
    }
    
}
