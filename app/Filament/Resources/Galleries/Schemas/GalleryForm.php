<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Models\GalleryCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // GALLERY IMAGE DETAILS
                Section::make('Gallery Image')
                    ->description('Upload and provide the details of your gallery image.')
                    ->schema([

                        FileUpload::make('image')
                            ->label('Upload Photograph')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('gallery')
                            ->visibility('public')
                            ->required()
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Image Title')
                            ->placeholder('e.g. Elegant Wedding Moments')
                            ->required()
                            ->maxLength(255),

                        Select::make('category')
                            ->label('Photography Category')
                            ->options(
                                fn () => GalleryCategory::query()
                                    ->orderBy('name')
                                    ->pluck('name', 'name')
                                    ->toArray()
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Select or create a category')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('New Category Name')
                                    ->placeholder('e.g. Graduation, Prenup, Birthday')
                                    ->required()
                                    ->maxLength(100)
                                    ->unique('gallery_categories', 'name'),
                            ])
                            ->createOptionUsing(function (array $data): string {
                                $category = GalleryCategory::firstOrCreate([
                                    'name' => trim($data['name']),
                                ]);

                                return $category->name;
                            }),

                        Textarea::make('description')
                            ->label('Image Description')
                            ->placeholder('Write a short description about this photograph...')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // DISPLAY SETTINGS
                Section::make('Display Settings')
                    ->description('Manage how this photograph appears on the customer gallery page.')
                    ->schema([

                        Toggle::make('is_published')
                            ->label('Publish Image')
                            ->helperText('Enabled: visible on the customer gallery. Disabled: hidden from customers.')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required()
                            ->helperText('Lower numbers appear first in the gallery.'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
