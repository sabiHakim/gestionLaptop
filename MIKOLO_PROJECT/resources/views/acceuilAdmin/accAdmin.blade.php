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
                    <div class="">
                        <div class="card info-card sales-card">
                            <div class="card-body pt-3">
                               <div class="d-flex align-items-center ">
                                   <h5 class="card-title">Listes Laptops</h5>
                                   <a  class="ms-3" href="{{url('pageAddLaptop')}}">
                                       <i class="  bi bi-plus-square-fill fs-5"></i>
                                   </a>
                               </div>
                                <div class="">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Marque</th>
                                            <th scope="col">Modele</th>
                                            <th scope="col">Proc</th>
                                            <th scope="col">Ram</th>
                                            <th scope="col">Ecran</th>
                                            <th scope="col">Dur</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($l))
                                            @foreach($l as $lap)
                                                <tr>
                                                    <th scope="row">{{$lap->marque}}</th>
                                                    <td>{{$lap->modele}}</td>
                                                    <td>{{$lap->processeur}}</td>
                                                    <td>{{$lap->ram}}</td>
                                                    <td>{{$lap->ecran}}</td>
                                                    <td>{{$lap->disque_dur}}</td>
                                                    <td>
                                                       <a  href="modifLap/{{$lap->id}}"> <i class=" text-primary bi bi-pencil"></i></a>
                                                        <a class="ms-2 text-danger bi bi-trash" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="{{$lap->id}}"></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="d-flex justify-content-center align-items-center w-100 ">Voulez-vous vraiment supprimez ?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-exclamation-triangle-fill  custom-icon-size text-danger"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                        <form action="{{url('deletelap')}}" method="get">
                            <input type="hidden" value="" name="id">
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteButtons = document.querySelectorAll('.bi-trash');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    var brandId = this.getAttribute('data-id');
                    document.querySelector('input[name="id"]').value = brandId;
                });
            });
        });
    </script>


@endsection
