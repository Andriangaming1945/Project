<?php

use App\Models\Guru;
use \App\Models\Siswa;
function rangking5B(){
    $siswa = Siswa::all();
    $siswa->map(function($s){
        $s->test = $s->test();
        return $s;
    });

    $siswa = $siswa->sortByDesc('test')->take(5);

    return $siswa;
}

function totalSiswa(){
    return Siswa::count();
}

function totalGuru(){
    return Guru::count();
}

?>