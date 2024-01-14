@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
@stop

@section('content')
    {{-- <p>Welcome to this beautiful
        {{ Auth::user()->level }}  panel</p> --}}
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

                <div class="sb-sidenav-footer">
                    <div class="small"></div>
                    {{-- Start Bootstrap --}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-4 col-md-6">

                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Barang
                                    <span class="badge bg-danger">{{ $totalBarang }}</span>
                                </div>

                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/barang">View Details</a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Permintaan Barang Pending
                                    <span class="badge bg-danger">{{ $totalPermintaan }}</span>

                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/permintaan-barang">View Details</a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Order
                                    <span class="badge bg-danger">{{ $totalOrder }}</span>

                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/admin/order">View Details</a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                </div>
            </main>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
