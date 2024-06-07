@extends('base.base')
@section('title','acceuil')
@section('content')
    <div class="pagetitle">
        <h1>PV</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item active">PV</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="">
                        <div class="card info-card sales-card">
                            <div class="card-body pt-3">
                                <div class="d-flex align-items-center ">
                                    <h5 class="card-title">Ventes : {{ session('pv')[0]->nom}}</h5>
                                </div>
                                <form method="get" action="{{url('traitventes')}}">
                                    @csrf
                                    @if(isset($res))
                                        <select class="form-select" aria-label="Default select example" name="lap">
                                            @foreach($res as $r)
                                                <option value="{{$r->id}}">{{$r->modele}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="mb-3 mt-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nbr vendus</label>
                                        <input type="text" name="nbr" class="form-control" id="exampleFormControlInput1" placeholder="nombre">
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark">Ventes</button>
                                </form>
                                @if(session('sup'))
                                    <div class="alert alert-danger mt-2 text-center"> {{session('sup')}} </div>
                                @endif
                                @if(session('diso'))
                                    <div class="alert alert-danger mt-2 text-center"> {{session('sup')}} </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection
