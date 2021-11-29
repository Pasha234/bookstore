<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Sight;
use App\Models\Order;
use App\Models\Product;
use Orchid\Screen\Fields\Relation;
use Illuminate\Database\Eloquent\Model;

class OrderItemsResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order_item::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('order_id')
                ->fromModel(Order::class, 'id')
                ->title('Order ID'),

            Relation::make('product_id')
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

            TD::make('order_id'),

            TD::make('product_id'),
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
            Sight::make('order_id', 'Order ID'),
            Sight::make('product_id', 'Product ID')
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
            'order_id' => 'required|integer',
            'product_id' => 'required|integer'
        ];
    }
}
