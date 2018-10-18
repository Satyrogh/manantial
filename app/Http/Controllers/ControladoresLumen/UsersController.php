<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    function index()
    {
            $users = User::all();
            return View::make('home') -> with('users', $users);
    }
    function crearUsuario(Request $request){
    	if($request->isJson()){
    		$data = $request->json()->all();
    		$user = User::create([
    			'name' => $data['name'],
    			'username' => $data['username'],
    			'email' => $data['email'],
    			'password' => Hash::make($data['password']),
    			'api_token' => str_random(60)
    		]);
            return response()->json([$user], 201);
        }
        return response()->json(['error' => 'No Autorizado'], 401, []);
    }
    function getToken(Request $request){
    	if($request->isJson()){
    		try{
                $data = $request->json()->all();
                $user = User::where('username', $data['username'])->first();
                if($user && Hash::check($data['password'], $user->password)){
                    return response()->json($user, 201);
                }else{
                    response()->json(['error'=>'No existe'],406);
                }
    		}catch(ModelNotFoundException $ex){
                return response()->json([$ex], 406);
    		}
        }
        return response()->json(['error' => 'No Autorizado'], 401, []);
    }
    function registroUsuario(){
        $user = User::create([
            'name' => Input::get('regNombreC'),
            'username' => Input::get('regNombreU'),
            'email' => Input::get('regEmail'),
            'password' => Hash::make(Input::Get('regPwd')),
            'api_token' => str_random(60)
        ]);
        return response()->json([$user], 201);
    }
    function verificarLogueo(){
        if(Auth::check()){
            return view('logueado');
        }else{
            echo "wakala";
        }
     
    }
    function loguearse(){
        // Obtenemos los datos del formulario
        try{
        $data = [
            'username' => Input::get('nombreUsuario'),
            'password' => Input::get('pwdUsuario')
        ];

        $user = User::where('username', $data['username'])->first();
        if($user && Hash::check($data['password'], $user->password)){
           return view('logueado');
        }else{
           response()->json(['error'=>'No existe'],406);
        }
        // Si los datos no son los correctos volvemos al login y mostramos un error
        }catch(ModelNotFoundException $ex){
            return response()->json([$ex], 406);
        }
    }

    public function desloguearse()
    {
        // Cerramos la sesión
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        return Redirect::to('/')->with('error_message', 'Logged out correctly');
    }

    public function delete($user_id){
        $user = User::find($user_id);
        if(is_null($user)){
            return Redirect::to('/');
        }
        $user->delete();
        return Redirect::to('user');
    }

}
