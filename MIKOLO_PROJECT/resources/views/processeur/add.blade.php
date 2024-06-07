@extends('base.baseAdmin')
@section('title','acceuilAdmin')
@section('content')
    <div class="pagetitle">
        <h1>Magasin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="acceuil">Home</a></li>
                <li class="breadcrumb-item active">Magasin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="">
                        <div class="card info-card sales-card">
                            <div class="card-body pt-3">
                                <div class="d-flex align-items-center ">
                                    <h5 class="card-title">Add Processeur</h5>
                                </div>
                                <form action="{{url('traitp')}}" method=" get">
                                    @csrf

                                    <div class="row" >
                                        <div class="col-lg-12 form-floating">
                                            <input type="text" class="form-control" id="floatingPassword" placeholder="marque" name="marque">
                                            <label for="floatingPassword">Processeur</label>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="  mt-3 col-lg-12 btn btn-outline-primary"> Add</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection
