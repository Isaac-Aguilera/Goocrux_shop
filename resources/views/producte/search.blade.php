@extends('layouts.app')

@stack('styles')
<link href="{{ asset('css/search.css') }}" rel="stylesheet">

@section('content')
<main class="main" role="main">
    <div class="album py-5 bg-light">
        <div class="container" style="margin-top: 60px;">
            <div class="row">
                @if($productesearch->count() < 1)
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4 class="alert alert-danger text-center">Nothing could be found!</h4>
                    </div>
                @else
                    @foreach($productesearch as $producte)
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="card mb-4 shadow">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <a href="{{ route('producte', $producte->id) }}">
                                                <img class="miniaturas w-100 card-img-top"
                                                    src="/{{ $producte->image }}" alt="">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <strong><span title="{{ $producte->name }}">
                                                    <blade
                                                        if|%20(%20Str%3A%3Alength(%24producte-%3Ename)%20%3E%3D%2090)>
                                                        {{ Str::of($producte->name)->limit(87, ' ...') }}

                                                    @else
                                                        <span>{{ $producte->name }}</span>
                                                    @endif
                                                </span></strong><br><br>
                                            <span class="text-danger">Price:</span> <span
                                                class="h4 font-weight-bold text-danger">{{ $producte->preu }}€</span><br><br>
                                            <span class="text-muted" title="{{ $producte->description }}">
                                                <blade
                                                    if|%20(%20Str%3A%3Alength(%24producte-%3Edescription)%20%3E%3D%20184)>
                                                    {{ Str::of($producte->description)->limit(181, ' ...') }}

                                                @else
                                                    {{ $producte->description }}
                                                @endif

                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <a href='{{ $producte->prod_url }}'
                                                            class="btn btn-lg btn-block w-100 h-100 font-weight-bold"
                                                            style="background-color:#ffa700; color: white;">
                                                            BUY IT NOW ON amazon.com <i class="fa fa-amazon"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
</main>
@endsection

<script type="text/javascript" src="{{ asset('js/image.js') }}"></script>
