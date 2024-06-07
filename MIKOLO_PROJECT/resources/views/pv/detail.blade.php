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
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">user</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($res))
                                                <tr>
                                                    <th scope="row">{{$res->nom}} </th>
                                                    <th scope="row">{{$res->nbruser}}</th>
                                                </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <form action="{{url('traitT')}}" method=" get">
                                        @csrf
                                        <input type="hidden" name="idsend" value="{{$res->id}}">
                                        @if(isset($res))
                                        @php
                                          $result = \App\Models\Pv::getpv_where_not($res->id);
                                        @endphp
                                        <div class="row">
                                            <div class=" col-lg-6 form-floating mb-3">
                                                <select name="idreceive" class="form-select" aria-label="Default select example">
                                                    <option selected>pv</option>
                                                    @foreach($result as $results)
                                                        <option value="{{$results->id}}">{{$results->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class=" col-lg-6 form-floating">
                                                <input type="text" class="form-control" id="floatingPassword" placeholder="NbrUser" name="nbr">
                                                <label for="floatingPassword">nbr a transferer</label>
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
