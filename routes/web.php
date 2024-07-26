<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


Route::get('/insert', function (Post $post) {
   
    $post->user_id = 1;
    $post->title = 'Testando' . Str::random(10);
    $post->body = '12x34';
    $post->date = date('Y-m-d');

    $post->save();

    $posts = $post->get();
    return $posts;
});

Route::get('/orderby', function (User $user) {
   
    $users = $user->orderBy('name', 'desc')->get();

    
    return $users;
});

Route::get('/pagination', function (User $user) {
   
    $users = $user->paginate(10);

    /** Paginate no Blade */
    // {{$users->links()}}

    
    return $users;
});

Route::get('/where', function (User $user) {
    $filter = 'Carlos';
    //$users = $user->where('email', '=', 'camille.gaylord@example.net')->first();
    //$users = $user->where('email', 'camille.gaylord@example.net')->first();

    //$users = $user->where('name', 'LIKE', "%{$filter}%")->orWhere('name', 'LIKE', '%Ku%')->first();

    $users = $user->where('email', 'camille.gaylord@example.net')
                    ->orWhere(function($query){
                        $query->where('name', '<>', 'Carlos');
                    })->first();

    dd($users);
});

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
