<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    // READ crear funcion para extraer estudiantes
    public function selectStudent()
    {
        // realizar un select * from estudiante
        $estudiantes = Estudiante::all();

        // validar si obtengo registros
        if ($estudiantes->count() > 0) { // si hay registros
            // enviar respuesta en formato json
            return response()->json([
                'code' => 200,
                'data' => $estudiantes
            ], 200);
        } else { // si no hay registros
            // enviar respuesta en formato json
            return response()->json([
                'code' => 200,
                'data' => 'No hay registros'
            ], 200);
        }
    }

    // CREATE funcion para almacenar nuevos estudiantes 
    public function storeStudent(Request $request)
    {
        //validar datos que se reciben en la peticion
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);

        if ($validacion->fails()) { //si la validacion no es correcta arrojar error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            //si no hay error
            $estudiante = Estudiante::create($request->all());

            //retornar mi respuesta en formato json
            return response()->json([
                'code' => 200,
                'data' => 'Estudiante insertado'
            ], 200);
        }
    }

    //UPDATE funcion para actualizar un estudiante 
    public function updateStudent(Request $request, $id)
    {
        //validar datos que se reciben en la peticion 
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
        ]);

        if ($validacion->fails()) { //si la validacion no es correcta arrojar error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            //si no hay error
            $estudiante = Estudiante::find($id);
            if ($estudiante) {
                //Si el estudiante existe
                $estudiante->update([
                    'nombre' => $request->nombre,
                    'edad' => $request->edad,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono
                ]);


                //retornar una respuesta en formato json 
                return response()->json([
                    'code' => 200,
                    'data' => 'Estuadiante actualizado'
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'Estuadiante no encontrado'
                ], 404);
            }
        }
    }

    //READ funcion para buscar estudiante por id 
    public function findStudent($id)
    {
        //buscar
        $estudiante = Estudiante::find($id);

        //validar si existe el estudiante
        if ($estudiante) {
            return response()->json([
                'code' => 200,
                'data' => $estudiante
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data' => 'Estudiante no encontrado'
            ], 404);
        }
    }

    //DELETE funcion para eliminar un estudiante 
    public function deleteStudent($id)
    {
        //buscar
        $estudiante = Estudiante::find($id);

        //validar si existe el estudiante
        if ($estudiante) {
            //eliminamos
            $estudiante->delete();

            //respuesta
            return response()->json([
                'code' => 200,
                'data' => 'Estudiante eliminado'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data' => 'Estudiante no encontrado'
            ], 404);
        }
    }
}
