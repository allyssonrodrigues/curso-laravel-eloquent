<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/select', function(){
    //$users = User::all();
    //$users->map(fn($user)=> dd($user->name));

    //$user = User::where('id', '>', 10)->first();
    //dd($user->name);
    
    /** Consulta o primeiro registro da tabela */
    $user = User::first();

    /** Procura pela ID da tabela */
    $user = User::find(10);

    /** Usado para API porque retorna 404 se não localizar o registro */
    $user = User::findOrFail(101);

    $user = User::where('name', 'José')->firstOrFail();

    $user = User::firstWhere('name', 'José');

});

/*teste*/
Route::get('/', function () {
    return view('welcome');
});
