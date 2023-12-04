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

    /**
     * Unit Owners
     *
     * @return User
     */
    public function owners()
    {
        return $this->belongsToMany('App\Models\User', 'unit_occupancy', 'unit', 'user')
            ->with(['profile'])
            ->withPivot(['is_primary', 'is_owner'])
            ->wherePivot('is_owner', 1)
            ->withTimestamps();
    }

    /**
     * Unit Tenants
     *
     * @return User
     */
    public function tenants()
    {
        return $this->belongsToMany('App\Models\User', 'unit_occupancy', 'unit', 'user')
            ->with(['profile'])
            ->withPivot(['is_primary', 'is_owner'])
            ->wherePivot('is_owner', 0)
            ->withTimestamps();
    }
}