<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama_belakang','nama_depan','jenis_kelamin','agama','alamat', 'avatar', 'user_id'];

    public function getAvatar(){
        if(!$this->avatar){
            return asset('images/default.png');
        }

        return asset('images/' .$this->avatar);
    }
    
    public function mapel(){
        return $this->belongsToMany(Mapel::class)->withPivot('nilai')->withTimestamps();
    }

    public function test(){
        $total = 0;
        $hitung = 0;
    
        foreach($this->mapel as $mapel){
            $total += $mapel->pivot->nilai;
            $hitung++;
        }
    
        if ($hitung === 0){

            return $hitung;
        }
    
        return round($total / $hitung);
    }
    

    public function nama_lengkap(){
        return $this->nama_depan.''.$this->nama_belakang;
    }

   
    
    
}
