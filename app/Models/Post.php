<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // /** Quando precisar usar outro nome da tabela no banco*/
    // protected $table = 'postagens';

    // /** Quando quiser usar outro nome no campo ID da tabela */
    // protected $primaryKey = 'id_postagens';

    // /** Muda o tipo da chave ID */
    // protected $keyType = 'string';

    // /** Desabilita o AutoIncremente da Tabela */
    // protected $incrementing = false;

    // /** Desabilitar o campo TimesTamps */
    // protected $timestamps = true;

    // const CREATED_AT = 'data_criacao';
    // const UPDATED_AT = 'data_atualizacao';

    // protected $dateFormat = 'd-m-Y';

    // /** Definir Model para utilizar outro banco */
    // protected $connection = 'pgsql';

    // /** Definir um valor default para os atributos */
    // protected $attributes = [ 
    //     'title' => 'Testando a aplicação Laravel'
    // ];
}
