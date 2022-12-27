<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Peticione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeticionesController extends Controller
{
    public function index(Request $request)
    {
        $peticiones = Peticione::all();
        return $peticiones;
    }
    public function listMine(Request $request)
    {
// parent::index()
//$user = Auth::user();
        $id = 1;
        $peticiones = Peticione::all()->where('user_id', $id);
        return $peticiones;
    }
    public function show(Request $request, $id)
    {
        $peticion = Peticione::findOrFail($id);
        return $peticion;
    }
    public function update(Request $request, $id)
    {
        $peticion = Peticione::findOrFail($id);
        $peticion->update($request->all());
        return $peticion;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'titulo' => 'required|max:255',
                'descripcion' => 'required',
                'destinatario' => 'required',
                'categoria_id' => 'required',
                'image' => 'required',
            ]);
        $input = $request->all();
        $file=$request->file('image');
        $category = Category::findOrFail($input['categoria_id']);
$user = Auth::user(); //asociarlo al usuario authenticado
        $peticion = new Peticione($input);
$peticion->user()->associate($user);
        $peticion->categoria()->associate($category);
        $peticion->firmantes = 0;
        $peticion->estado = 'pendiente';
        $peticion->image=$path;
        $peticion->save();
        return $peticion;
    }

        public function firmar(Request $request, $id)
    {
        try {
            $peticion = Peticione::findOrFail($id);
            $user = Auth::user();
            $firmas = $peticion->firmas;
            foreach ($firmas as $firma) {
                if ($firma->id == $user->id) {
                    return response()->json(['message' => 'Ya has firmado esta petición'], 403);
                }
            }
            $user_id = [$user->id];
            $peticion->firmas()->attach($user_id);
            $peticion->firmantes = $peticion->firmantes + 1;
            $peticion->save();
        } catch (\Throwable$th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
        return response()->json(['message' => 'Peticion firmada satisfactioriamente', 'peticion' => $peticion], 201);
    }

    public function cambiarEstado(Request $request, $id)
    {
        $peticion = Peticione::findOrFail($id);
        $peticion->estado = 'aceptada';
        $peticion->save();
        return $peticion;
    }
    public function destroy(Request $request, $id)
    {
        $peticion = Peticione::findOrFail($id);
        $peticion->delete();
        return $peticion;
    }
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
}
