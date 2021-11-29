<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\Sight;

class FeedbackResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Feedback::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('user_id')
                ->fromModel(User::class, 'name', 'id')
                ->title('User ID')
                ->required(),

            Relation::make('product_id')
                ->fromModel(Product::class, 'name', 'id')
                ->title('Product ID')
                ->required(),

            Input::make('grade')
                ->title('Grade')
                ->required()
                ->placeholder('Enter a grade (from 1 to 5)'),

            TextArea::make('text')
                ->title('Text')
                ->placeholder('Enter text of the feedback')
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

            TD::make('user_id', 'User ID'),

            TD::make('product_id', 'Product ID'),

            TD::make('grade', 'Grade'),

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
            Sight::make('product_id', 'Product ID'),
            Sight::make('grade', 'Grade'),
            Sight::make('text', 'Text'),
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
            'product_id' => 'required|integer',
            'grade' => 'required|integer|max:5|min:1',
            'text' => 'required|string|max:400'
        ];
    }
}
