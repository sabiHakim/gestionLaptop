@extends('base.baseAdmin')
@section('title','acceuilAdmin')
@section('content')
    <link href="{{ asset('assets/leaflet/leaflet.css') }}" rel="stylesheet">
    <style>
        #map {
            height: 500px;
            width: 50%;
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
                                    <h5 class="card-title">Modif Pv</h5>
                                </div>
                                <form action="{{url('traitmodifpv')}}" method="get">
                                    @csrf
                                            <input type="hidden" value="{{$res->id}}" name="idpv">
                                    <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row" >
                                            <div class="col-lg-6 form-floating">
                                                <input type="text" class="form-control" id="floatingPassword" placeholder="nbruser" name="nbruser" value="{{$res->nbruser}}">
                                                <label for="floatingPassword">nbruser</label>
                                            </div>
                                            <div class="col-lg-6 form-floating">
                                                <input type="text" class="form-control" id="floatingPassword" placeholder="nom" name="nom" value="{{$res->nom}}">
                                                <label for="floatingPassword">Nom</label>
                                            </div>

                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6 form-floating mb-3" id="lat">
                                                <input type="text" class="form-control" id="latitude" placeholder="latitude" name="latitude" value="{{$res->latitude}}">
                                                <label for="latitude">latitude</label>
                                            </div>
                                            <div class="col-lg-6 form-floating" id="long">
                                                <input type="text" class="form-control" id="longitude" placeholder="longitude" name="longitude" value="{{$res->longitude}}">
                                                <label for="longitude">longitude</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="map"></div>
                                    </div>
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
    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
    <script>
        var map = L.map('map').setView([-18.766947, 46.869107], 6);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        @if(isset($res))
        var marker = L.marker([{{$res->latitude}},{{$res->longitude}}],{
                draggable:true
            }).addTo(map)
            .bindPopup(L.Util.template('<div><strong>NOM :</strong> {nom}<br><strong>NBR USER :</strong> {nbruser}</div>', {
                nom: "{{ $res->nom }}",
                nbruser: "{{ $res->nbruser }}"
            }))
            .addTo(map);

        marker.on('dragend', function(event) {
            var marker = event.target;
            var position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
            console.log("Latitude: " + position.lat + ", Longitude: " + position.lng);

        });
        @endif
    </script>
@endsection
