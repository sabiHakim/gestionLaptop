@extends('base.base')
@section('title','acc')
@section('content')
    <style>
        .bout{
            margin-left: 20px;
        }
    </style>
    <div class="pagetitle">
        <h1>Magasin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">PV</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <style>
        .custom-icon-size {
            font-size: 48px; /* Ajustez cette valeur pour changer la taille de l'icône */
        }
    </style>
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li class="dropdown-item" >
                                        <div>
                                            <form action="{{url('traitstatpv')}}" method="get">
                                                @if(isset($res))
                                                    <select class="form-select" aria-label="Default select example" name="date">
                                                        @foreach($res as $r)
                                                            <option value="{{$r->year}}">{{$r->year}}</option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-outline-info  mt-2 text-center">Filtrer</button>
{{--                                                    <a href="{{url('histo',['annee'=>$r->year])}}" class="btn btn-warning mt-2"> Voir Histogramme</a>--}}
                                                @endif
                                            </form>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Chiffres <span>| D'affaires</span></h5>
                                @if(isset($ress))
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            @foreach($ress as $r)
                                                <h6>{{$r->month}} </h6>
                                                <span class="text-success small pt-1 fw-bold">{{$r->ca}} ar</span>
                                            @endforeach

                                        </div>
{{--                                        <a href="{{url('export')}}" class="btn btn-outline-warning bout">Export PDF</a>--}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><!-- End Sales Card -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>



@endsection
