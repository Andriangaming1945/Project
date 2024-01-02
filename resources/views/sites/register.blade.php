@extends('layouts.frontend')

@section('content')
<section class="banner-area relative about-banner" id="home">	
    <div class="overlay overlay-bg"></div>
    <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Pendaftaran				
                </h1>	
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="about.html"> Pendaftaran akun</a></p>
            </div>	
        </div>
    </div>
</section>

<section class="search-course-area relative" style="background: unset;">
    
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-3 col-md-6 search-course-left">
                <h1>
                    Daftar Akun <br>
                    disini!
                </h1>
                <p>
                   
Memiliki akun di banyak situs web bisa memberikan beberapa manfaat yang berbeda<br>Seperti memberikan akses layanan, kemudahan interaksi, manfaat eksklusif, personalisasi, keamanan data, dan pengelolaan riwayat aktivitas.
                </p>
                <div class="row details-content">
                    <div class="col single-detials">
                        <span class="lnr lnr-graduation-hat"></span>
                        <a href="#"><h4>Expert Instructors</h4></a>		
                       						
                    </div>
                    <div class="col single-detials">
                        <span class="lnr lnr-license"></span>
                        <a href="#"><h4>Certification</h4></a>		
                       					
                    </div>								
                </div>
            </div>
            <div class="col-lg-45 col-md-6 search-course-right section-gap">
                
               {!! Form::open(['url' => '/postregister', 'class' => 'form-wrap'])!!}
               
                    <h4 class="pb-20 text-center mb-30">Fomulir pendaftaran</h4>
                    {!!Form::text('nama_depan', '', ['class' => 'form-control', 'placeholder' => 'Nama Depan'  ])!!}
                    {!!Form::text('nama_belakang', '', ['class' => 'form-control', 'placeholder' => 'Nama belakang'  ])!!}
                    {!!Form::text('agama', '', ['class' => 'form-control', 'placeholder' => 'Agama'  ])!!}  
                    {!!Form::textarea('alamat', '', ['class' => 'form-control', 'placeholder' => 'Alamat'  ])!!}
                    <div class="form-select" id="service-select">
                        {!! Form::select('jenis_kelamin', ['L' => 'Laki laki', 'P' => 'Perempuan'], 'L', ['style' => 'display: none;']) !!}
                    </div>
                    
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}

                    <input type="submit" class="primary-btn text-uppercase" value="Kirim" style="text-align: center;">
                {!!Form::close()!!}
            </div>
        </div>
    </div>	
</section>
@stop