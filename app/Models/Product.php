<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Product Class
 *
 * This model represents the product entity in the database.
 * It extends the Eloquent Model class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 * @method static create(array $validated)
 * @method static find(string $id)
 * @method static inRandomOrder()
 */
class Product extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    // Define the table name
    protected $table = 'products';

    // Define the primary key field
    protected $primaryKey = 'id';

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

    // Define the primary key type
    protected $keyType = 'string';

    // Define the fields that are guarded against mass assignment
    protected $guarded = ['id'];

    // Define the fields that are fillable
    protected $fillable = ['name', 'description', 'price'];

    // Define the casts for certain attributes
    protected $casts = [
        'stock' => 'integer', // Cast the 'stock' attribute to integer
        'created_at' => 'datetime:Y-m-d H:i:s', // Cast 'created_at' attribute to datetime format
        'updated_at' => 'datetime:Y-m-d H:i:s' // Cast 'updated_at' attribute to datetime format
    ];

    /**
     * Define a one-to-many relationship with the Stock model.
     *
     * @return HasMany
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function stocks(): HasMany
    {
        // Define a one-to-many relationship where a product has many stock entries
        // The 'product_id' column in the 'stocks' table references the 'id' column in the 'products' table
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }
}
