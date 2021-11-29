<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Illuminate\Database\Eloquent\Model;

class CategoryResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

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
                ->placeholder('Enter the name of the category')
                ->required(),
            
            Input::make('img')
                ->title('Image')
                ->placeholder('Enter the name of the img')
                ->required()
                ->help('The name of the image located in /staticfiles/img/'),

            Input::make('link')
                ->title('Link')
                ->placeholder('Enter the name of the link')
                ->required()
                ->help('Enter the name of the link that will be displayed in browser'),
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

            TD::make('link'),
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
            Sight::make('link'),
            Sight::make('img'),
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
            'name' => 'required|string|max:32',
            'link' => 'required|string|max:32',
            'img' => 'required|string|max:32',
        ];
    }
}
