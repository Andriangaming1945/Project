<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function home(){
        return view('sites.home');
    }

    public function about(){
        return view('sites.about');
    }

    public function register(){
        return view('sites.register');
    }

    public function postregister(Request $request){
        $user = new \App\Models\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60); // Generating a random token
        $user->save();

        $request->request->add(['user_id' => $user->id]); // Merge the 'user_id' into the request data
        
        $siswa = \App\Models\Siswa::create($request->all());

        return redirect('/')->with('sukses', 'Data akun berhasil terkirim!');
    }
}
