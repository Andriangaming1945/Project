@extends('layouts.master')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop
@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            @if(session('sukses'))
            <div class="alert alert-success" role="alert">
                {{session('sukses')}}
              </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
              </div>
            @endif
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar">
                                <h3 class="name">{{$siswa->nama_depan}}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{$siswa->mapel->count()}} <span>Brp Mata pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        {{$siswa->test()}} <span>Rata rata nilai</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        2174 <span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Profile diri</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin}}</span></li>
                                    <li>Agama <span>{{$siswa->agama}}</span></li>
                                    <li>Alamat <span>{{$siswa->alamat}}</span></li>
                                    
                                </ul>
                            </div>
                            
                            <div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-primary">Edit Profile</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Tambah nilai
  </button>
  
 
  
                        
                        <!-- END AWARDS -->
                        <!-- TABBED CONTENT -->
                       
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mata pelajaran</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAMA</th>
                                            <th>SEMESTER</th>
                                            <th>NILAI</th>
                                            <th>GURU</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswa->mapel as $mapel)
                                        <tr>
                                            <td>{{$mapel->kode}}</td>
                                            <td>{{$mapel->nama}}</td>
                                            <td>{{$mapel->semester}}</td>
                                            <td><a href="#" class="nilai" data-type="text" data-pk="{{$mapel->id}}" data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Masukkan nilai">{{$mapel->pivot->nilai}}</a></td>
                                            <td><a href="/siswa/{{$mapel->guru_id}}/profile">{{$mapel->guru->nama}}</a></td>
                                            <td> <a href="/siswa/{{$siswa->id}}/{{$mapel->id}}/deletetnilai" class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="chartNilai"></div>
                        </div>
                        
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<div class="panel-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>RANKING</th>
                <th>NAMA</th>
                <th>NILAI</th>
                
            </tr>
        </thead>
        <tbody>

            @php
                $ranking = 1;
            @endphp
            @foreach(rangking5B() as $segs)
            <tr>
                <td>{{$ranking}}</td>
                <td>{{$segs->nama_depan}} {{$segs->nama_belakang}}</td>
                <td>{{$segs->test}}</td>
            

          
                
            </tr>
            @php
            $ranking++;
        @endphp
            @endforeach
        </tbody>
    </table>
</div>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah nilai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/siswa/{{$siswa->id}}/addnilai" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="mapel">Mata pelajaran</label>
                    <select class="form-control" id="mapel" name="mapel">
                      @foreach($matapelajaran as $mp)
                        <option value="{{$mp->id}}">{{$mp->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group{{$errors->has('nama_depan') ? ' has-error' : ''}}">
                  <label for="exampleInputEmail1">Nilai</label>
                  <input name="nilai" type="Text" class="form-control" id="exampleIText1" aria-describedby="emailHelp" placeholder="Nilai" value="{{old('nilai')}}">
                  @if($errors->has('nilai'))
                      <span class="help-block">{{$errors->first('nilai')}}</span>
                    @endif
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@stop

@section('footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan nilai siswa'
    },
    xAxis: {
        categories: [
            @foreach($siswa->mapel as $mapel)
                '{{$mapel->nama}}',
            @endforeach
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    series: [{
        name: 'Grafik nilai',
        data: [
            @foreach($siswa->mapel as $mapel)
                {{$mapel->pivot->nilai}},
            @endforeach
        ]
    }]
});

$(document).ready(function() {
    $('.nilai').editable();
});
</script>
@stop