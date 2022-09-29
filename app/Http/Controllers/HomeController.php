<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sucursales = Sucursal::all();

        $user = User::findOrFail(Auth::user()->id);
        
        if($user->sucursal_id != null){
            session(['sucursal' => $user->sucursal]);
            return redirect()->route('inventarios');
        }

        return view('home', compact('sucursales'));
    }

    public function seleccionar($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->sucursal_id != null){
            return back()->with('error', 'No estás permitido para seleccionar sucursal');
        }

        try {
            $sucursal = Sucursal::findOrFail($id);
            session(['sucursal' => $sucursal]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->route('home');
    }
}
