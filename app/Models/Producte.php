<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property float $preu
 * @property string $prod_url
 * @property string $updated_at
 * @property string $created_at
 * @property Category $category
 * @property User $user
 */
class Producte extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Productes';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'name', 'description', 'image', 'preu', 'prod_url', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
