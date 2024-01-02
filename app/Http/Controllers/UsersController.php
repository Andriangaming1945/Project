<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function upload(Request $request)
    {   

        Excel::import(new \App\Imports\UsersImport,$request->file('users'));
       //dd($request->all());
    }
}
