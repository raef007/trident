<?php
namespace App\Estate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estate_community';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organization',
        'name',
        'classification',
        'city',
        'state',
        'country',
        'created_at'
    ];
    
    public function units()
    {
        return $this->hasMany('App\Estate\Models\Unit', 'estate', 'id')->orderBy('created_at', 'DESC');
    }
    
}