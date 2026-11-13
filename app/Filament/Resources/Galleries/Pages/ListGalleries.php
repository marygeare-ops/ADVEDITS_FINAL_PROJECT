<?php

namespace App\Filament\Resources\Galleries\Pages;

use App\Filament\Resources\Galleries\GalleryResource;
use App\Models\Gallery;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Collection;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected string $view = 'filament.resources.galleries.pages.list-galleries';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Image')
                ->icon('heroicon-o-plus')
                ->createAnother(false),
        ];
    }

    public function getGalleryImages(): Collection
    {
        return Gallery::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();
    }

    public function togglePublished(int $id): void
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->update([
            'is_published' => ! $gallery->is_published,
        ]);

        Notification::make()
            ->title($gallery->is_published ? 'Image published' : 'Image hidden')
            ->success()
            ->send();
    }

    public function deleteGallery(int $id): void
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->delete();

        Notification::make()
            ->title('Gallery image deleted')
            ->success()
            ->send();
    }
}
