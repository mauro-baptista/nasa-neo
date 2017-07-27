<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neo extends Model
{
    /**
     * Define table name for this model
     * @var string
     */
    protected $table = 'neos';

    /**
     * Define items where its allowed the mass assignment
     * @var array
     */
    protected $fillable = [
        'date', 'reference', 'name', 'speed', 'is_hazardous',
    ];

    /**
     * Define type where fields must be retrieve from database
     * @var array
     */
    protected $casts = [
        'speed' => 'decimal',
        'is_hazardous' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Scope a query to only include hazardous data
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsHazardous($query, $status = true)
    {
        return $query->where('is_hazardous', $status);
    }

    /**
     * Scope a query to only include the fastest item
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopefastest($query)
    {
        return $query->orderBy('speed', 'DESC')->limit(1);
    }

    /**
     * Scope a query to count and group
     * item by a given function
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCountIn($query, $function, $field = 'date')
    {
        $function = strtoupper($function);
        $as = strtolower($function);

        return $query->select(\DB::raw('count(id) as count'), \DB::raw("{$function}({$field}) {$as}"))
                    ->groupBy($as)
                    ->orderBy('count', 'DESC');
    }
}
