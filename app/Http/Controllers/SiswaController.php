<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Exports\SiswaExport;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\Contracts\DataTable;

class SiswaController extends Controller
{
    public function index(Request $request)
    {   
        if($request->has('cari')){
            $data_siswa = \App\Models\Siswa::where('nama_depan', 'LIKE', '%' .$request->cari. '%')->paginate(20);
        }else{
            $data_siswa = \App\Models\Siswa::all();
        }
       
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {   
        //dd($request->all());
        $this->validate($request, [
            'nama_depan' => 'required|min:5',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpg,png',
        ]);
        $user = new \App\Models\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('admin');
        $user->remember_token = Str::random(60); // Generating a random token
        $user->save();
        
        $request->request->add(['user_id' => $user->id]); // Merge the 'user_id' into the request data
        
        $siswa = \App\Models\Siswa::create($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data berhasil diinput');
        
    }

    public function edit( Siswa $siswa){
        
        return view('siswa/edit', ['siswa' => $siswa]);
    }

    public function update(Request $request,Siswa $siswa)
    {   
       
        $siswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil ter-update');
    }

    public function delete( Siswa $siswa){
        
        $siswa->delete($siswa);
        return redirect('/siswa')->with('sukses', 'Data berhasil terdelete');
    }

    public function profile(Siswa $siswa){
        
        $matapelajaran = \App\Models\Mapel::all();

        $categories =[];

        foreach($matapelajaran as $mp){
            $categories[] = $mp->nama;
        }

        //dd(json_encode($categories));
        return view('siswa.profile', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran, 'categories' => $categories]);
    }

    public function addnilai(Request $request, Siswa $siswa)
    
    {
        
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->with('error', 'Data nilai telah ada');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses', 'Data nilai berhasil dimasukan');
    }

    public function deletenilai($idsiswa, $idmapel){
        $siswa = \App\Models\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses', 'berhasil menghapus nilai');
    }

    public function export() 
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

  

    
    
}
