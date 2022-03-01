<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'group_id',
        'name',
        'email',
        'password',
    ];

    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'created_at_formated',
    ];

    public function getCreatedAtFormatedAttribute(){
        if(!$this->created_at || is_null($this->created_at)){
            return '-';
        }
        
        return Carbon::parse($this->created_at)->format(config('app.datetime_format'));
    }



    public function user(){
        return $this->belongsTo(User::class);
    }
}
