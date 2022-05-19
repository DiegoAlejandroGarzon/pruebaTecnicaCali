<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Http\Requests\userUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('Administrator')){
            return view('dashboard');
        }else{
            return view('clientIndex');
        }
    }
    
    public function create(userRequest $request){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al guardar el usuario',
        ];
        if(User::where('documentType', $request->documentType)->where('documentNumber', $request->documentNumber)->count() > 0){
            $data['mensaje'] = "Ya hay un registro de número de documento y tipo de documento con la misma combinación";
            return response()->json($data,200);
        }
        $user = new User();
        $user->firstName = $request->firstName;
        $user->secondName = $request->secondName;
        $user->surname = $request->surname;
        $user->secondSurname = $request->secondSurname;
        $user->documentType = $request->documentType;
        $user->documentNumber = $request->documentNumber;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            $user->assignRole('Client');
            $data=[
                'error'=>'off',
                'mensaje'=>'Usuario guardado con éxito',
            ];
        }
        return response()->json($data,200);
    }
    
    public function list(){
        $usuarios = User::whereNotIn('id', [Auth::user()->id])->get();
        // return $usuarios;
        $concatenaTabla=collect([]);
        foreach($usuarios as $usuario){
            $collectionTabla = collect([
                [
                    'id'=>$usuario->id,
                    'firstName'=>$usuario->firstName,
                    'secondName'=>$usuario->secondName,
                    'surname'=>$usuario->surname,
                    'secondSurname'=>$usuario->secondSurname,
                    'documentType'=>$usuario->documentType,
                    'documentNumber'=>$usuario->documentNumber,
                    'name'=>$usuario->name,
                    'email'=>$usuario->email,
                ]
            ]);
            $concatenaTabla = $collectionTabla->concat($concatenaTabla);
        }
        return response()->json(['data'=>$concatenaTabla],200);
    }
    
    public function update(userUpdateRequest $request){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al guardar el usuario',
        ];
        if(User::where('documentType', $request->documentType)->where('documentNumber', $request->documentNumber)->count() > 0){
            $data['mensaje'] = "Ya hay un registro de número de documento y tipo de documento con la misma combinación";
            return response()->json($data,200);
        }
        $user = User::find($request->idUser);
        $user->firstName = $request->firstName;
        $user->secondName = $request->secondName;
        $user->surname = $request->surname;
        $user->secondSurname = $request->secondSurname;
        $user->documentType = $request->documentType;
        $user->documentNumber = $request->documentNumber;
        $user->email = $request->email;
        if($user->save()){
            $data=[
                'error'=>'off',
                'mensaje'=>'Usuario Actualizado con éxito',
            ];
        }
        return response()->json($data,200);
    }
    
    public function delete($id){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al borrar el usuario',
        ];
        $usuario = User::find($id);
        if($usuario->delete()){
            $data = [
                'error'=>'off',
                'mensaje'=>'Usuario borrado correctamente'
            ];
        }
        return response()->json($data,200);
    }
}
