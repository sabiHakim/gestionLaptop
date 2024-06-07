@extends('base.baseAdmin')
@section('title','acceuilAdmin')
@section('content')
    <link href="{{ asset('assets/leaflet/leaflet.css') }}" rel="stylesheet">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .custom-icon-size {
            font-size: 48px;
        }
    </style>
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
                                    <h5 class="card-title">Point de vente</h5>
                                    <a  class="ms-3" href="{{url('pageAddpv')}}">
                                        <i class="  bi bi-plus-square-fill fs-5"></i>
                                    </a>
                                </div>
                                <div class="row mt-2 mb-2">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Lat</th>
                                            <th scope="col">longitude</th>
                                            <th scope="col">user</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($res))
                                            @foreach($res as $lap)
                                                <tr>
                                                    <th scope="row">{{$lap->nom}}</th>
                                                    <th scope="row">{{$lap->latitude}}</th>
                                                    <th scope="row">{{$lap->longitude}}</th>
                                                    <th scope="row">{{$lap->nbruser}}</th>
                                                    <td>
                                                        <a  href="modifpv/{{$lap->id}}"> <i class=" text-primary bi bi-pencil"></i></a>
                                                        <a class="ms-2 text-danger bi bi-trash" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="{{$lap->id}}"></a>
                                                        <a class="btn btn-outline-success ms-2 "  href="detailpv/{{$lap->id}}">  Transfert  </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div id="map"></div>
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
                    <p class="d-flex justify-content-center align-items-center w-100">Voulez-vous vraiment supprimer ?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-exclamation-triangle-fill custom-icon-size text-danger"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                        <form action="{{url('deletepv')}}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="">
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
<script>
    var map = L.map('map').setView([-18.766947, 46.869107], 6);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    @if(isset($res))
    @foreach($res as $r)
        L.marker([{{$r->latitude}},{{$r->longitude}}]).addTo(map)
            .bindPopup(L.Util.template('<div><strong>NOM :</strong> {nom}<br><strong>NBR USER :</strong> {nbruser}</div>', {
                nom: "{{ $r->nom }}",
                nbruser: "{{ $r->nbruser }}"
            }))
        .addTo(map);
    @endforeach
    @endif
</script>
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
