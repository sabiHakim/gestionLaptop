@extends('base_login.base_log')
@section('title','login')
{{--@section('title')--}}
{{--    Login--}}
{{--@endsection--}}
@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-center py-4">
                                <a href="#" class="d-flex align-items-center w-auto">
                                    <img  class="rounded"  src="{{asset('assets/img/téléchargement.png')}}" alt="" style="width: 150px; height: 150px">
                                    {{--                            <span class="d-none d-lg-block">##</span>--}}
                                </a>
                            </div><!-- End Logo -->
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Point De Vente</h5>
                                <p class="text-center small">Enter your username & password to login</p>
                            </div>
                                    <form class="row g-3 needs-validation"  action="{{ route('traitLoginpv') }}"method="get">
                                        @csrf
                                        @error('name')
                                        <div class=" mt-2 alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"> <i class="bi bi-file-lock2-fill"> </i> </span>
                                                <select name="pv" class="form-select" aria-label="Default select example">
                                                    @foreach($pv as $marque)
                                                        <option value="{{$marque->id}}">{{$marque->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-outline-dark w-100" type="submit">Login</button>
                                        </div>
                                        @if(session('inconito'))
                                            <div class=" text-center mt-2 alert alert-danger">{{ session('inconito') }}</div>
                                        @endif
                                        @if(session('error'))
                                            <div class=" text-center mt-2 alert alert-danger">{{ session('error') }}</div>
                                        @endif

                                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
