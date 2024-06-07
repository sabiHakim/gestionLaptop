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
                                    <h5 class="card-title">Add Laptops</h5>
                                </div>
                               <form action="{{url('traitlap')}}" method=" get">
                                   @csrf
                                    <div class="row">
                                        <div class=" col-lg-6 form-floating mb-3">
                                            <select name="marque" class="form-select" aria-label="Default select example">
                                                <option selected>Marque</option>
                                                @foreach($m as $marque)
                                                    <option value="{{$marque->id}}">{{$marque->nom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" col-lg-6 form-floating mb-3">
                                            <input type="text" class="form-control" id="" placeholder="Modele" name="modele">
                                            <label for="floatingPassword">Modele</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-lg-6 form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="proc">
                                                <option selected>Processeur</option>
                                                @foreach($p as $proc)
                                                    <option value="{{$proc->id}}">{{$proc->nom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" col-lg-6 form-floating">
                                            <input type="text" class="form-control" id="floatingPassword" placeholder="RAM" name="ram">
                                            <label for="floatingPassword">RAM</label>
                                        </div>
                                    </div>
                                   <div class="row" >
                                       <div class="col-lg-6 form-floating">
                                           <input type="text" class="form-control" id="floatingPassword" placeholder="ecran" name="ecran">
                                           <label for="floatingPassword">ecran</label>
                                       </div>
                                       <div class= " col-lg-6 form-floating">
                                           <input type="text" class="form-control" id="floatingPassword" placeholder="Dur" name="dur">
                                           <label for="floatingPassword">Dur</label>
                                       </div>
                                   </div>
                                   <div class="row ">
                                            <div class="col-lg-12 form-floating mt-3">
                                                <input type="text" class="form-control" id="floatingPassword" placeholder="prix" name="prix">
                                                <label for="floatingPassword">Prix</label>
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
