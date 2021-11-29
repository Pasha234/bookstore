<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Sight;
use Illuminate\Database\Eloquent\Model;

class OfferResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Offer::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('title')
                ->title('Title')
                ->placeholder('Enter the title of the offer')
                ->required(),
            
            TextArea::make('description')
                ->title('Description')
                ->placeholder('Enter the description')
                ->help('Enter the description that will be displayed on home page and the offer page')
                ->required(),

            Input::make('img')
                ->title('Image')
                ->placeholder('Enter the name of the img')
                ->help('The name of the image located in /staticfiles/img/')
                ->required(),

            CheckBox::make('is_compilation')
                ->sendTrueOrFalse()
                ->title('Compilation')
                ->help('The offer is a compilation')
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

            TD::make('title'),

            TD::make('is_compilation', 'Is Compilation'),

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
            Sight::make('title'),
            Sight::make('description'),
            Sight::make('img'),
            Sight::make('is_compilation', 'Is Compilation'),
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
     * resource validation
     * 
     * @return array
     */
    public function rules(Model $model): array
    {
        return [
            'title' => 'required|string|max:32',
            'description' => 'required|string|max:150',
            'img' => 'required|string|max:32',
            'is_compilation' => 'boolean'
        ];
    }
}
