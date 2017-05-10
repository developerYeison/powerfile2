<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;


use App\Estado;
use App\Grupo;
use App\Usuario;
use App\Grupo_usuario;

class GruposController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @return void
	 */


	public function index(Request $request)
	{
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		$grupos = DB::select('select g.id_grupo,g.nombre,d.descripcion from sgd_grupos g,sgd_estados d where g.id_estado = d.id_estado order by g.nombre asc');

		return view('grupos.index',compact('grupos'))->with('i', ($request->input('page', 1) - 1) * 5);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		$estados = Estado::pluck('descripcion', 'id_estado');
		return view('grupos.create')->with('estados',$estados);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		$v = \Validator::make($request->all(), [

				'nombre' => 'required|max:255',
				'id_estado' => 'required',
		]);
		 
		if ($v->fails())
		{
			Session::put('mensajeerror',trans("principal.msgerrrol"));
			return redirect()->back();
		}
		 
		Grupo::create($request->all());
	  
		//\Session::flash('flash_message', 'Mensaje de prueba');
	  
		Session::put('mensaje',trans("principal.msgexitogrup"));
	  
		return redirect()->route('grupos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		$estados = Estado::pluck('descripcion', 'id_estado');
		$grupos = Grupo::find($id);
		return view('grupos.edit',compact('grupos'))->with('estados',$estados);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//Update Query
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		$registro = Grupo::findOrFail($id);
		 
		$registro->nombre = $request->input('nombre');
		 
		$registro->id_estado = $request->input('id_estado');
		 
		$registro->save();
		 
		Session::put('mensaje',trans("principal.msgexitoeditgrup"));
		 
		return redirect()->route('grupos.index');
		 
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		$registro=Grupo::find($id);
		 
		$registro->delete();
		 
		Session::put('mensaje',trans("principal.msgelimgrup"));
		 
		return redirect()->route('grupos.index');
	}
	
	public function agrupar(Request $request, $id){
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
		 
		$grupos = Grupo::find($id);
		
		$usuarios = Usuario::pluck('name', 'id');
		 
		$userxgrupo = DB::select('select id_grupo_usuario,id_grupo,id_usuario from sgd_grupo_usuarios where id_grupo = '.$id);
		 
		//$totalg = DB::table('sgd_permisos')->get();
	
		//$totalr = count($totalr);  //total de registros
			
		//$permisos = Permiso::orderBy('id_permiso','ASC')->paginate($totalr);
		
		return view('grupos.agrupar',compact('grupos'))->with(['grupos'=>$grupos,'usuarios'=>$usuarios,'userxgrupo'=>$userxgrupo]);
		
	
	}
	 
	public function update_agrupar(Request $request, $id){
		 
		if (is_null(Session::get('id_usuario')))
		{
			return redirect('/');
		}
	
		$usuarios = $request->input('usuarios_grupo');
		
		$grupoid = $request->input('idgrupo'); 	
		
		//se elimina cualquier permiso agrupamiento de ese grupo
		 
		$grupos = DB::select('delete from sgd_grupo_usuarios where id_grupo = '.$id);
		
		if (count($usuarios) > 0)
			{
		
					
				for ($i = 0; $i < count($usuarios); $i++) {
					
					$registro = new Grupo_usuario;
					
					$registro->id_grupo = $grupoid;
					 
					$registro->id_usuario = $usuarios[$i];
					 
					$registro->save();
					
					Session::put('mensaje',trans("principal.msgagrupa"));
						
					return redirect()->route('grupos.index');
					
				}
			}
		else
			{
				return redirect()->route('grupos.index');
			}
	}
	 
}