<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Whence extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * @return mixed
     */
    public static function getAllCached()
    {
        $cacheKey = (new self)->getTable();

        return Cache::remember($cacheKey, now()->addDay(365), function () {
            return self::all();
        });
    }
}
