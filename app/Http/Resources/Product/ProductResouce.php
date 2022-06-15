<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'name' => $this->name,
            'description' => $this->details,
            'price'  => $this->price,
            'stock'  => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'discount' => $this->discount,
            'TotalPrice' => round((1 - ($this->discount/100)) * $this->price, 2),
            'rating'  => $this->review->count() > 0 ? round($this->review->sum('star')/$this->review->count(), 2) : 'No reting Yet',
            'href' =>[
                'review' => route('review.index',$this->id)
            ]
        ];
    }
}
