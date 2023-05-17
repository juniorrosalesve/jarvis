<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index() {
        $clientes   =   Cliente::all();

        return view('dashboard', [
            'clientes' => $clientes
        ]);
    }

    public function add(Request $r) {
        $create =   $r->except('_token');
        $vence  =   date('Y-m-d', strtotime(now()."+".$r->vence." days"));
        $create['vence']    =   $vence;
        Cliente::create($create);
        return '<script>alert("Añadido correctamente!");location.href="'.route('dashboard').'"</script>';
    }

    public function remove($id) {
        $cliente    =   Cliente::find($id);
        if(empty($cliente))
            return redirect()->route('dashboard');
        Cliente::where('id', $id)->delete();
        return '<script>alert("Eliminado correctamente!");location.href="'.route('dashboard').'"</script>';
    }
}
