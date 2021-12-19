<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Direction;

class ProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Name')
                ->placeholder('Enter the name')
                ->required(),
            
            Input::make('price')
                ->title('Price')
                ->placeholder('Enter the price')
                ->required(),
            
            Input::make('previous_price')
                ->title('Previous price')
                ->placeholder('Enter the previous price (if exists)'),

            Input::make('img')
                ->title('Image')
                ->placeholder('Enter the name of the image')
                ->required(),

            Relation::make('category')
                ->title('Category')
                ->placeholder('Select category')
                ->fromModel(Category::class, 'name', 'id')
                ->required(),

            Input::make('publisher')
                ->title('Publisher')
                ->placeholder('Enter the name of the publisher (if exists)'),

            Input::make('author')
                ->title('Author')
                ->placeholder('Enter the name of the author (if exists)'),
            
            Input::make('cover')
                ->title('Cover')
                ->placeholder('Enter the type of cover of the book (if exists)'),

            Input::make('year')
                ->title('Year')
                ->placeholder('Enter the year of publishing (if exists)'),

            Relation::make('direction')
                ->title('Direction')
                ->placeholder('Select a direction')
                ->fromModel(Direction::class, 'name', 'id')
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

            TD::make('name'),

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
            Sight::make('name'),
            Sight::make('price'),
            Sight::make('previous_price'),
            Sight::make('img'),
            Sight::make('category'),
            Sight::make('publisher'),
            Sight::make('author'),
            Sight::make('cover'),
            Sight::make('year'),
            Sight::make('direction'),
            Sight::make('created_at')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            Sight::make('updated_at')
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
     * Validation rules
     * 
     * @return array
     */
    public function rules(Model $model) : array
    {
        return [
            'name' => 'required|string|max:32',
            'price' => 'required|numeric|max:99999',
            'previous_price' => 'numeric|max:99999|nullable',
            'img' => 'required|string|max:32|nullable',
            'category' => 'required|integer',
            'publisher' => 'string|max:32|nullable',
            'author' => 'string|max:32|nullable',
            'cover' => 'string|max:32|nullable',
            'year' => 'integer|nullable',
            'direction' => 'integer|required'
        ];
    }
}
