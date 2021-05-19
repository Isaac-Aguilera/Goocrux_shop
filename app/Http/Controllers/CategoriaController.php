<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Lista los productos de una categoria.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /**
         * En el caso de que la id de la categoria que hemos pasado sea 0, cojemos todos los productos, en el caso de que sea 1 o 2 cogera audio o
         * video.
         */
        $a = "";
        if ($request['id'] == 0) {
            $productes = Producte::orderBy('created_at', 'DESC')->get();
        } else {
            $productes = Producte::orderBy('created_at', 'DESC')->where("category_id", "=", $request['id'])->get();
        }

        /**
         * Por cada producto crea una card con lo que mostraremos en la vista
         */
        foreach ($productes as $producte) {
            $a = $a . '<div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card mb-4 shadow">';
            if (isset(Auth::user()->id)) {
                $a = $a . '<div class="dropdown">
                        <button class="btn dropdown-toggle btn-dark" style="position:absolute; border-radius:0; " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical font-weight-bold"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="text-decoration-none" href="/editarProducte/' . $producte->id . '"><button class="dropdown-item" >Edit</button></a>
                        </div>
                    </div>';
            }
            $a = $a . '<a href="' . route('producte', $producte->id) . '">
                <img class="card-img-top miniaturas" src="/' . $producte->image . '" alt="">
                </a>
                <div class="card-body d-flex flex-column">  
                    <p class="card-title font-weight-bolder" title="' . $producte->name . '">' . Str::of($producte->name)->limit(29, ' ...') . '</p>
                    <div class="row">
                        <div class="col-12">
                            <p class="" title="' . $producte->description . '">' . Str::of($producte->description)->limit(170, ' ...') . '</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 class=" font-weight-bold">' . $producte->preu . '&euro;</h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <a href="' . $producte->prod_url . '" class="btn btn-lg btn-block w-100 h-100 font-weight-bold" style="background-color:#ffa700; color: white;">
                            BUY IT NOW ON amazon.com <i class="fa fa-amazon"></i>
                        </a>';
            $a = $a . '</div>
                </div>
            </div>
        </div>';
        }

        /**
         * En el caso de que no haya nada en la variable $a significa que no existe ningun producto, asi que devolvemos un error
         * en el caso contrario devuelve la variable $a que mostraremos en la vista
         */
        if ($a == "") {
            return "<div class='col-lg-12 col-md-12 col-sm-12'>
            <h4 class='alert alert-danger text-center'>There are no products of " . Categoria::find($request['id'])->name . " category!</h4>
        </div>";
        } else {
            return $a;
        }
    }
}
