@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <!-- Total Mobil -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mobil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMobils }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Mobil Disewa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mobil Disewa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMobilsDisewa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobil Terbaru -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="card-title">Mobil Terbaru</h5>
                    <ul class="list-group">
                        @foreach ($latestMobils as $mobil)
                            <li class="list-group-item">{{ $mobil->nama }} - {{ $mobil->plat_nomor }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection