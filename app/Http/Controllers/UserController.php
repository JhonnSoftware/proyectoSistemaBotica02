<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $users = User::all();
        
        // Pasar los clientes a la vista
        return view('users.index', compact('users'));
    }
}
