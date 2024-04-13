<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Stock Class
 *
 * This model represents the stock entity in the database.
 * It extends the Eloquent Model class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 * @method static selectRaw(string $string)
 * @method static where(string $string, string $id)
 * @method static create(array $all)
 * @method static find(string $id)
 */
class Stock extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    // Define the table name
    protected $table = 'stocks';

    // Define the primary key field
    protected $primaryKey = 'id';

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

    // Define the primary key type
    protected $keyType = 'string';

    // Define the fields that are guarded against mass assignment
    protected $guarded = ['id'];

    // Define the fields that are fillable
    protected $fillable = ['product_id', 'type', 'stock'];

    // Define the casts for certain attributes
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s', // Cast 'created_at' attribute to datetime format
        'updated_at' => 'datetime:Y-m-d H:i:s' // Cast 'updated_at' attribute to datetime format
    ];

    /**
     * Define a many-to-one relationship with the Product model.
     *
     * @return BelongsTo
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function product(): BelongsTo
    {
        // Define a many-to-one relationship where a stock belongs to a product
        // The 'product_id' column in the 'stocks' table references the 'id' column in the 'products' table
        return $this->belongsTo(Product::class);
    }
}
