@extends('base.baseAdmin')
@section('title','acceuilAdmin')
@section('content')
    <div class="pagetitle">
        <h1>Magasin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('acceuil')}}">Home</a></li>
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
                                <form action="{{url('traitmodifm')}}" method="get">
                                    @csrf
{{--                                        @foreach($res as $re)--}}
{{--                                    @endforeach--}}
                                    @if(isset($res))
                                        <input type="hidden" value="{{$res->id}}" name="idm">
                                        <div class="row">

                                            <div class=" col-lg-6 form-floating mb-3">
                                                <input type="text" class="form-control" id="" placeholder="Modele" name="nom" value="{{$res->nom}}">
                                                <label for="floatingPassword">nom</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                        <button class="  mt-3 col-lg-12 btn btn-outline-primary"> Modifier</button>
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
