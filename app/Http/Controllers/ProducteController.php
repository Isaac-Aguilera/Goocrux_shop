<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProducteController extends Controller
{
    /**
     * Devuelve la view de crear producto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!isset(Auth::user()->id)) {
            return redirect('login');
        }
        return view('producte.create')->with('categories', Categoria::orderBy('name')->get());
    }

    /**
     * Crea un nuevo producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');

        $data = $request->all();
        Validator::make($data, [
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'min:5'],
            'image' => ['required', 'image', 'dimensions:min_width=200,min_height=200'],
            'preu' => ['required', 'numeric'],
            'prod_url' => ['required', 'string', 'min:5'],

        ])->validate();

        /**
         * Pone en el storage la imagen que hemos pasado y pone la variable $i en el $data image y creamos el nuevo producto con todos los datos
         *
         */
        $i = $data['image']->store('images');
        $data['image'] = $i;
        $producte = new Producte($data);
        $producte->save();


        return redirect()->route('pujarProducte')->with(['message' => 'Product created correctly']);
    }

    /**
     * Devuelve la ruta detalle si existe el producto con la id que hemos especificado sino devuelve que no existe ese producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $producte = Producte::find($request->route('id'));
        if (isset($producte)) {
            return view('producte.detall')->with(['producte' => $producte])->with('categories', Categoria::orderBy('name')->get());
        } else {
            return view('producte.detall')->with(['error' => "Product not found!"]);
        }
    }

    /**
     * Devuelve la view de editar producto en el caso de que exista el producto especificado por la id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!isset(Auth::user()->id)) {
            return redirect('login');
        }
        $producte = Producte::find($request->route('id'));
        if (isset($producte)) {
            return view('producte.edit')->with(['producte' => $producte])->with('categories', Categoria::orderBy('name')->get())->with('nomCategoria', Categoria::find($producte->category_id)->name);
        } else {
            return view('producte.edit')->with(['error' => "Product not found!"]);
        }
    }

    /**
     * Cambia un producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->middleware('auth');

        $producte = Producte::find($request->route('id'));
        $data = $request->all();
        Validator::make($data, [
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'min:5'],
            'image' => ['image', 'dimensions:min_width=200,min_height=200'],
            'preu' => ['required', 'numeric'],
            'prod_url' => ['required', 'string', 'min:5'],

        ])->validate();

        /**
         * Si existe una nueva imagen que hemos pasado por el formulario, la mete en el storage y elimina la que habia antes y hace que la imagen de
         * $data sea la nueva imagen y finalmente lo actualiza en la base de datos.
         */
        if (isset($data['image'])) {
            $i = $data['image']->store('images');
            Storage::delete($producte->image);
            $data['image'] = $i;
        }
        $producte->update($data);

        return redirect()->route('editarProducte', $producte->id)->with(['message' => 'Product updated correctly']);
    }

    /**
     * Elimina un producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /**
         * Buscamos el producto en la base de datos del cual hemos pasado la id y eliminamos la imagen del storage y eliminamos el producto por completo
         */
        $id = $request['id'];
        $producte = Producte::find($id);
        Storage::delete($producte->image);
        $producte->delete();
    }

    /**
     * lista los productos que coincidan con la busqueda.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Coje el valor de la busqueda
        $search = $request->input('search');

        /**
         * Buscamos los productos que se parezcan a la busqueda que ha hecho el usuario
         */

        $posts = Producte::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();



        // Search in the title and body columns from the posts table

        // Return the search view with the resluts compacted
        return view('producte.search')->with('productesearch', $posts);
    }
}
