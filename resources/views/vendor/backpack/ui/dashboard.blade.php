@extends(backpack_view('blank'))

@php
    $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    ];
@endphp

@section('header')
    <div class="container-fluid pt-3 mb-1">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body" style="padding-left: 30px">
                    <h5 class="card-title mb-0">Hi, {{ auth()->user()->name }}</h5>
                    <i class="hide-mobile">Selamat datang di admin panel website PIHPS Kepri.</i>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12 col-md-8 my-md-4 my-2 order-2 order-md-0">
                    </div>
                    <div class="col-sm-12 col-md-4 my-4 order-1 order-md-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
