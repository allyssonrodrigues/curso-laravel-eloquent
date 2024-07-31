<?php

use App\Models\Post;
use App\Models\User;
use App\Scopes\YearScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/** Eventos */
Route::get('/eventos', function (Post $post, Request $request) {
    $post = Post::create([
        'title' => 'Um novo título '. Str::random(10),
        'body' => Str::random(100),
        'date' => now()
    ]);

    return $post;
});

/** Observer */
Route::get('/observer', function (Post $post, Request $request) {
    $post = Post::create([
        'title' => 'Um novo título '. Str::random(10),
        'body' => Str::random(100),
        'date' => now()
    ]);

    return $post;
});

/** Scopos Globais */
Route::get('/global-scopes', function (Post $post, Request $request) {
    $posts = Post::get();

    /** Não utilizar o scopo global */
    //$posts = Post::withoutGlobalScope(YearScope::class)->get();

    return $posts;
});

/** Scopos Globais anônimo*/
Route::get('/anonymous-global-scopes', function (Post $post, Request $request) {
    //$posts = Post::get();

    /** Não utilizar o scopo global */
    $posts = Post::withoutGlobalScope('year')->get();

    return $posts;
});

Route::get('/local-scope', function (Post $post, Request $request) {
    $posts = Post::lastWeek()->get();

    return $posts;
});

Route::get('/mutators', function (Post $post, Request $request) {
    $user = User::first();

    $post = Post::create([
        'user_id' => $user->id,
        'title' => 'Um novo título '. Str::random(10),
        'body' => Str::random(100),
        'date' => now()
    ]);

    return $post;

});

Route::get('/accessor', function (Post $post, Request $request) {
    $post = Post::first();

    return $post->getTitleBodyAttribute();
});

Route::get('/soft_deleting', function (Post $post, Request $request) {
    Post::destroy(3);

    dd(Post::get());
});

Route::get('/delete', function (Post $post, Request $request) {
   
    /** Pode passar um array ou uma collection para deletar */
    // Post::destroy(id);
    $post = $post->find(3);

    $post->delete();

    dd(Post::get());
});

Route::get('/update', function (Post $post, Request $request) {
   
    $post = $post->find(1);

    $post->title = 'Alterando o post';
    $post->save();

    dd($post);
});

Route::get('/insert_mass', function (Post $post, Request $request) {
   
    $post = $post->create($request->all());
    
    $posts = $post->get();
    return $posts;
});

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
