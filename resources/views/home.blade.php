@extends('layouts.app')
@stack('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

@section('content')
<div class="row">
    <div class="col-2" style="margin-top:80px;">
        <div id="mySidenav" class="sidenav position-fixed">
            <a style="cursor:pointer;" onclick="cambiarCategoria(0,'{{ csrf_token() }}')" class="bg-dark" id="home">Home
                <i class="bi bi-house-fill"></i></a>
            <a style="cursor:pointer;" onclick="cambiarCategoria(2,'{{ csrf_token() }}')" class="bg-dark mt-2"
                id="video">Video <i class="bi bi-camera-fill"></i></a>
            <a style="cursor:pointer;" onclick="cambiarCategoria(1,'{{ csrf_token() }}')" class="mt-2 bg-dark"
                id="audio">Audio <i class="bi bi-mic-fill"></i></a>
        </div>
    </div>

    <div class="col-10">
        <main class="main" role="main">
            <div class="album py-5 bg-light">

                <div class="container" style="margin-top: 60px;">
                    <div id="productes" class="row">
                        @foreach(App\Models\Producte::orderBy('created_at','DESC')->get() as $producte)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card mb-4 shadow">
                                    @if(isset(Auth::user()->id))
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle btn-dark"
                                                style="position:absolute; border-radius:0; " type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical font-weight-bold"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="text-decoration-none"
                                                    href="/editarProducte/{{ $producte->id }}"><button
                                                        class="dropdown-item">Edit</button></a>
                                            </div>
                                        </div>
                                    @endif
                                    <a href="{{ route('producte', $producte->id) }}">
                                        <img class="card-img-top miniaturas" src="/{{ $producte->image }}">
                                    </a>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-title font-weight-bolder" title="{{ $producte->name }}">
                                            {{ Str::of($producte->name)->limit(29, ' ...') }}
                                        </p>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="" title="{{ $producte->description }}">
                                                    {{ Str::of($producte->description)->limit(170, ' ...') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class=" font-weight-bold">{{ $producte->preu }}&euro;</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <a href='{{ $producte->prod_url }}'
                                                class="btn btn-lg btn-block w-100 h-100 font-weight-bold"
                                                style="background-color:#ffa700; color: white;">
                                                BUY IT NOW ON amazon.com <i class="fa fa-amazon"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection

<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
