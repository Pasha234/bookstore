<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class ShoplistResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Shoplist::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('user_id')
                ->title('User ID')
                ->placeholder('Select user\'s name')
                ->fromModel(User::class, 'name', 'id')
                ->required(),

            Relation::make('item_id')
                ->title('Product ID')
                ->placeholder('Select item\'s name')
                ->fromModel(Product::class, 'name', 'id')
                ->required(),

            Input::make('quantity')
                ->title('Quantity')
                ->placeholder('Enter the quantity')
                ->required(),
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
            Sight::make('user_id', 'User ID'),
            Sight::make('item_id', 'Item ID'),
            Sight::make('quantity', 'Quantity'),
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
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|numeric|min:1'
        ];
    }
}
