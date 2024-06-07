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
                                    <h5 class="card-title">Buy Lap</h5>
                                </div>
                                <form action="{{url('traitAchat')}}" method=" get">
                                    @csrf
                                    <div class="row">
                                        <div class=" col-lg-6 form-floating mb-3">
                                            <select name="lap" class="form-select" aria-label="Default select example">
                                                <option selected>Nos Laptops</option>
                                             @if(isset($res))
                                                    @foreach($res as $marque)
                                                        <option value="{{$marque->id}}">{{$marque->modele}}</option>
                                                    @endforeach
                                             @endif
                                            </select>
                                        </div>
                                        <div class=" col-lg-6 form-floating mb-3">
                                            <input type="number" class="form-control" id="" placeholder="nbr" name="nbr">
                                            <label for="floatingPassword">NBR</label>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="  mt-3 col-lg-12 btn btn-outline-success"> Buy </button>
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
