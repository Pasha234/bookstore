<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Sight;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('recipient')
                ->title('Recipient')
                ->placeholder('Enter the name of the recipient')
                ->required(),
            
            Input::make('address')
                ->title('Address')
                ->placeholder('Enter the address of the recipient')
                ->required(),

            DateTimer::make('indicativeDeliveryDate')
                ->title('Indicative Delivery Date')
                ->required(),

            Input::make('sum')
                ->title('Sum')
                ->placeholder('Enter the sum of the order')
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
            Sight::make('recipient'),
            Sight::make('address'),
            Sight::make('indicativeDeliveryDate', 'Indicative Delivery Date'),
            Sight::make('sum'),
            Sight::make('created_at', 'Created At')
            ->render(function ($model) {
                return $model->created_at->toDateTimeString();
            }),
            Sight::make('updated_at', 'Updated, At')
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
            'recipient' => 'required|string|max:32',
            'address' => 'required|string|max:32',
            'indicativeDeliveryDate' => 'required|date',
            'sum' => 'required|numeric|max:99999'
        ];
    }
}
