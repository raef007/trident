<?php
namespace App\Estate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estate_units';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'estate',
        'label',
        'address',
        'billing_day',
        'photo',
        'tags',
        'created_at'
    ];
    
    /**
     * Community of the Unit
     *
     * @return Unit
     */
    public function community()
    {
        return $this->belongsTo('App\Estate\Models\Community', 'estate')->withTrashed();
    }
}