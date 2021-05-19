@extends('layouts.app')
@stack('styles')
<link href="{{ asset('css/detall.css') }}" rel="stylesheet">

@section('content')
<div id="container" class="container shadow pb-3" style="margin-top: 100px;">
    <div class="row pr-3">
        <div class="col-lg-8 col-xs-12 mb-3">
            @if(isset($error))
                <div class="card">
                    <div class="card-header">Error!</div>
                    <div class="card-body">
                        <p>{{ $error }}</p>
                    </div>
                </div>
            @else
        </div>
        <div class="row">
            <div class="col-6">
                <img class="miniaturas w-100" src="/{{ $producte->image }}" alt="">
            </div>

            <div class="col-6">
                <h4 class="font-weight-bolder">{{ $producte->name }}</h4>
                <hr>
                <span class="text-danger">Price: </span> <span
                    class="h4 text-danger font-weight-bolder mt-3">{{ $producte->preu }}€</span>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="font-weight-bold">About this article</h6>
                        <p class="mt-3">{{ $producte->description }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href='{{ $producte->prod_url }}' class="btn btn-lg btn-block w-100 h-100 font-weight-bold"
                            style="background-color:#ffa700; color: white;">
                            BUY IT NOW ON amazon.com <i class="fa fa-amazon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
