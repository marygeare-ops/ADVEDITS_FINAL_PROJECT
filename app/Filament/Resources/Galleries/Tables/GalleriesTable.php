<?php

namespace App\Filament\Resources\Galleries\Tables;

use App\Models\Gallery;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image')
                    ->label('Photograph')
                    ->disk('public')
                    ->height(190)
                    ->width('100%')
                    ->extraImgAttributes([
                        'class' => 'w-full object-cover rounded-xl',
                    ]),

                TextColumn::make('title')
                    ->label('Image Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(90)
                    ->wrap()
                    ->toggleable(),

                ToggleColumn::make('is_published')
                    ->label('Published')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Display Order')
                    ->sortable(),

            ])

            // Display records as visual cards
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])

            ->filters([
                SelectFilter::make('category')
                    ->label('Photography Category')
                    ->options(
                        fn () => Gallery::query()
                            ->whereNotNull('category')
                            ->where('category', '!=', '')
                            ->distinct()
                            ->orderBy('category')
                            ->pluck('category', 'category')
                            ->toArray()
                    ),

                SelectFilter::make('is_published')
                    ->label('Publication Status')
                    ->options([
                        1 => 'Published',
                        0 => 'Hidden',
                    ])
                    ->attribute('is_published'),
            ])

            ->recordActions([
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square'),

                DeleteAction::make()
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation(),
            ])

            ->defaultSort('sort_order', 'asc')

            ->paginated([12, 24, 48, 'all']);
    }
}
