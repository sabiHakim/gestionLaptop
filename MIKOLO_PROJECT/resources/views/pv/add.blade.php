@extends('base.baseAdmin')
@section('title','acceuilAdmin')
@section('content')
    <link href="{{ asset('assets/leaflet/leaflet.css') }}" rel="stylesheet">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
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
                                    <h5 class="card-title">Add Pv</h5>
                                </div>
                               <form action="{{url('traitpv')}}" method=" get">
                                   @csrf
                                    <div class="row">
                                        <div class=" col-lg-6 form-floating">
                                            <input type="text" class="form-control" id="floatingPassword" placeholder="Nbr User" name="user">
                                            <label for="floatingPassword">Nbr User</label>
                                        </div>
                                        <div class=" col-lg-6 form-floating">
                                            <input type="text" class="form-control" id="floatingPassword" placeholder="Nbr User" name="nom">
                                            <label for="floatingPassword">Nom</label>
                                        </div>
                                    </div>
                                   <div class="row mt-3" >
                                       <div class="col-lg-6 form-floating">
                                           <input type="text" class="form-control" id="floatingPassword" placeholder="lat" name="lat">
                                           <label for="floatingPassword">lat</label>
                                       </div>
                                       <div class= " col-lg-6 form-floating">
                                           <input type="text" class="form-control" id="floatingPassword" placeholder="long" name="long">
                                           <label for="floatingPassword">long</label>
                                       </div>
                                   </div>
                                   <div>
                                       <button class="  mt-3 col-lg-12 btn btn-outline-primary"> Add</button>
                                   </div>
                               </form>

                            </div>
                            <div id="map"></div>
                            <form action="{{url('traitpvmap')}}" method="get">
                                <div id="form">
                                    <!-- Les champs cachés pour les coordonnées seront ajoutés ici dynamiquement -->
                                </div>
                                <label for="nom">Nom:</label>
                                <input type="text" id="nom" placeholder="Entrez le nom">
                                <label for="nbruser">Nombre d'utilisateurs:</label>
                                <input type="number" id="nbruser" placeholder="Entrez le nombre">
                                <button type="submit">Valider</button>
                            </form>
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

        map.on('click', function(e) {
            var nameInput = document.getElementById('nom');
            var userCountInput = document.getElementById('nbruser');
            // Vérifier que les valeurs saisies ne sont pas vides
            if (nameInput.value && userCountInput.value) {
                var lat = e.latlng.lat;
                var lon = e.latlng.lng;

                // Créer un nouveau marqueur à la position cliquée
                var marker = L.marker([lat, lon]).addTo(map);
                marker.bindPopup("Marqueur placé ici.").openPopup();

                // Ajouter les inputs cachés pour stocker les coordonnées
                var formDiv = document.getElementById('form');
                var latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'latitude[]';
                latInput.value = lat;
                formDiv.appendChild(latInput);
                var lonInput = document.createElement('input');
                lonInput.type = 'hidden';
                lonInput.name = 'longitude[]';
                lonInput.value = lon;
                formDiv.appendChild(lonInput);
                // Ajouter les valeurs saisies par l'utilisateur aux champs cachés
                var nameHiddenInput = document.createElement('input');
                nameHiddenInput.type = 'hidden';
                nameHiddenInput.name = 'nom[]';
                nameHiddenInput.value = nameInput.value;
                formDiv.appendChild(nameHiddenInput);
                var userCountHiddenInput = document.createElement('input');
                userCountHiddenInput.type = 'hidden';
                userCountHiddenInput.name = 'nbruser[]';
                userCountHiddenInput.value = userCountInput.value;
                formDiv.appendChild(userCountHiddenInput);
                // Réinitialiser les champs de saisie après ajout des données
                nameInput.value = '';
                userCountInput.value = '';
            } else {
                alert('Veuillez entrer un nom et un nombre d\'utilisateurs avant de cliquer sur la carte.');
            }
        });

    </script>

@endsection
