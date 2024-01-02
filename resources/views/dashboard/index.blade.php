@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title btn btn-info" style="color: white;">Ranking 5 besar</h3>

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
</div>
<div class="col-md-3">
    <div class="metric">
        <span class="icon"><i class=" fa fa-user"></i></span>
        <p>
            <span class="number">{{totalSiswa()}}</span>
            <span class="title">Total siswa</span>
        </p>
    </div>
</div>

<div class="col-md-3">
    <div class="metric">
        <span class="icon"><i class="fa fa-user"></i></span>
        <p>
            <span class="number">{{totalGuru()}}</span>
            <span class="title">Total Guru</span>
        </p>
    </div>

</div>
</div>
</div>
</div>
</div>

@stop