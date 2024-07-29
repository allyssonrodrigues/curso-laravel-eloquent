<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime:d/m/Y'
    ] ;

    /** Local Scopes */
    public function scopeLastWeek($query)
    {
        return $this->whereDate('date', '>=', now()->subDays(4))
                    ->whereDate('date', '<=', now()->subDays(1));
    }

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

    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }

    public function getTitleBodyAttribute()
    {
        return $this->title.' '.$this->body;
    }

    public function getDateAttribute($value)
    {
        return Carbon::make($value)->format('d/m/Y');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::make($value)->format('Y-m-d');
    }

}
