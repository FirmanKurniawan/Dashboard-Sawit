@extends('layouts.index')
@section('css')

@endsection
@section('js')
<script src="{{asset('stisla/dist/assets/modules/chart.min.js')}}"></script>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-car-side"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Truck</h4>
                </div>
                <div class="card-body">
                    4
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                <i class="fas fa-network-wired"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Sensors</h4>
                </div>
                <div class="card-body">
                    4
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="fas fa-bell"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Notifications</h4>
                </div>
                <div class="card-body">
                    0
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Users</h4>
                </div>
                <div class="card-body">
                    1
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </div>
@endsection
