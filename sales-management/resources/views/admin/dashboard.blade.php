@extends('layouts/admin_template')

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class='row'>
                <div class='col-md-12'>
                    <center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <img src="{{ asset('images/bkm_logo.png') }}"
                            alt="Logo"
                            style="opacity: .8; width:120px;">
                        <br>
                        <br>
                        <h3>Selamat Datang,</h3>
                        <h1>Halaman Admin</h1>
                        
                        <br>
                        <br>
                        <h4 class="text-warning">
                        @if(Session::has('msg'))
                        {!! Session::get('msg') !!} 
                        @endif
                        </h4>
                    </center>
                </div><!-- /.col -->
            </div><!-- /.row -->
        <div>

    </section>
    <!-- /.content -->
@endsection