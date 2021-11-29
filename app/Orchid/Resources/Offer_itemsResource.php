<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Sight;
use Orchid\Screen\Fields\Relation;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Offer_itemsResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Offer_items::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('offer_id')
                ->fromModel(Offer::class, 'title', 'id')
                ->title('Offer ID'),

            Relation::make('item_id')
                ->fromModel(Product::class, 'name', 'id')
                ->title('Product ID')
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('offer_id', 'Offer ID'),
            Sight::make('item_id', 'Item ID'),
            Sight::make('created_at', 'Created At')
            ->render(function ($model) {
                return $model->created_at->toDateTimeString();
            }),
            Sight::make('updated_at', 'Updated At')
            ->render(function ($model) {
                return $model->updated_at->toDateTimeString();
            }),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * resource validation
     * 
     * @return array
     */
    public function rules(Model $model): array 
    {
        return [
            'offer_id' => 'required|integer',
            'item_id' => 'required|integer'
        ];
    }
}
