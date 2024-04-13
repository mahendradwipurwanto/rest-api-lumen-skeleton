<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * StockResource Class
 *
 * This resource class represents the JSON structure of a stock entry.
 * It extends the JsonResource class provided by Laravel.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array JSON representation of the stock resource.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function toArray(Request $request): array
    {
        // This method transforms the stock entry resource into an array representation.
        // In this case, it returns the resource as an array by calling the parent's toArray method.
        return parent::toArray($request);
    }
}
