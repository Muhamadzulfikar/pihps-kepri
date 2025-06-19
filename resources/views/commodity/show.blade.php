@extends(backpack_view('blank'))
@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.preview') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <div class="container-fluid d-flex align-items-center justify-content-between my-3">
        <section class="header-operation animated fadeIn d-flex mb-2 align-items-baseline d-print-none"
                 bp-section="page-header">
            <h1 class="text-capitalize mb-0"
                bp-section="page-heading">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</h1>
            <p class="ms-2 ml-2 mb-0"
               bp-section="page-subheading">{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}</p>
            @if ($crud->hasAccess('list'))
                <p class="ms-2 ml-2 mb-0" bp-section="page-subheading-back-button">
                    <small><a href="{{ url($crud->route) }}" class="font-sm"><i
                                class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                            <span>{{ $crud->entity_name_plural }}</span></a></small>
                </p>
            @endif
        </section>
        <div class="d-flex">
            <a href="{{ url($crud->route.'/'.$entry->uuid.'/edit') }}"
           class="btn btn-warning me-1" data-bs-toggle="tooltip"
           data-bs-placement="top" data-bs-title="Edit Komoditas"
        >
            <i class="la la-edit text-black"></i>
        </a>
        @include('commodity.buttons.delete')
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row display-flex-wrap">
                    <div class="col-md-12 col-xs-12">
                        <div class="card table-responsive">
                            <div class="card-status-start bg-primary"></div>

                            <div class="card-body">
                                <table class="table table-hover table-vcenter">
                                    <tbody>
                                    <tr>
                                        <td><b>Nama</b></td>
                                        <td>{{ $entry->name }}</td>

                                        <td><b>Kategori</b></td>
                                        <td>{{ $entry->category }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Jenis Pasar</b></td>
                                        <td>{{ $entry->market_text }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabs -->
                            <div class="card">

                                <!-- Header Tabs -->
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#markets" role="tab" data-toggle="tab"
                                               data-name="#markets"
                                               data-bs-toggle="tab" class="nav-link active">
                                                <i class="las la-stream"></i><b>Pasar</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end header tabs -->

                                <!-- body tabs -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="markets">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box no-padding no-border">
                                                        @include('commodity.tabs.market.show')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Body Tab -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
