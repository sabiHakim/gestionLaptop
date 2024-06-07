@extends('base.baseAdmin')
@section('title','acceuilAdmin')
@section('content')
    <div class="pagetitle">
        <h1>Magasin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('acceuil')}}">Home</a></li>
                <li class="breadcrumb-item active">Transfert</li>
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
                                <div class="row mt-2 mb-2">
                                </div>
                                <div class="row">
                                    <form action="{{url('traitTransfertLap')}}" method=" get">
                                        @csrf
                                        @if(isset($res)&&isset($lap))
                                            <div class="row">
                                                <div class=" col-lg-4 form-floating mb-3">
                                                    <select name="pv" class="form-select" aria-label="Default select example">
                                                        @foreach($res as $results)
                                                            <option value="{{$results->id}}">{{$results->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class=" col-lg-4 form-floating mb-3">
                                                    <select name="lap" class="form-select" aria-label="Default select example">
                                                        @foreach($lap as $results)
                                                            <option value="{{$results->id}}">{{$results->modele}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class=" col-lg-4 form-floating">
                                                    <input type="text" class="form-control" id="floatingPassword" placeholder="NbrUser" name="nbr">
                                                    <label for="floatingPassword">nbr laptop a transferer</label>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="  mt-3 col-lg-12 btn btn-outline-warning"> Transferer</button>
                                            </div>
                                        @endif
                                        @if(session('ex'))
                                            <div class="alert alert-danger"> {{session('ex')}} </div>
                                        @endif
                                        @if(session('sup'))
                                            <div class="alert alert-danger text-center mt-3"> {{session('sup')}} </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection
