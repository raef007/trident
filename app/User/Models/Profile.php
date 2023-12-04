<?php
namespace App\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'address',
        'city',
        'state',
        'country',
        'contact_number',
        'created_at'
    ];
    
    /**
     * User Account
     *
     * @return User
     */
    public function account()
    {
        return $this->belongsTo('App\Models\User', 'user')->withTrashed();
    }
}