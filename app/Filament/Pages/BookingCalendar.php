<?php
namespace App\Filament\Pages;

use App\Models\Service;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\Rule;

class BookingCalendar extends Page
{
    protected string $view = 'filament.pages.booking-calendar';

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $title = 'Services';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCamera;

    public ?int $serviceId = null;

    public bool $showModal = false;

    public array $form = [
        'event_type' => 'Wedding',
        'name' => '',
        'service_type' => 'Photography',
        'description' => '',
        'price' => '',
        'coverage_hours' => '',
        'photographer_count' => '',
        'videographer_count' => '',
        'edited_photo_count' => '',
        'video_duration' => '',
        'inclusions_text' => '',
        'is_active' => true,
        'sort_order' => 0,
    ];

    public function openCreateModal(): void
    {
        $this->resetValidation();

        $this->serviceId = null;

        $this->form = [
            'event_type' => 'Wedding',
            'name' => '',
            'service_type' => 'Photography',
            'description' => '',
            'price' => '',
            'coverage_hours' => '',
            'photographer_count' => '',
            'videographer_count' => '',
            'edited_photo_count' => '',
            'video_duration' => '',
            'inclusions_text' => '',
            'is_active' => true,
            'sort_order' => 0,
        ];

        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $service = Service::findOrFail($id);

        $this->resetValidation();

        $this->serviceId = $service->id;

        $this->form = [
            'event_type' => $service->event_type,
            'name' => $service->name,
            'service_type' => $service->service_type,
            'description' => $service->description ?? '',
            'price' => $service->price,
            'coverage_hours' => $service->coverage_hours ?? '',
            'photographer_count' => $service->photographer_count ?? '',
            'videographer_count' => $service->videographer_count ?? '',
            'edited_photo_count' => $service->edited_photo_count ?? '',
            'video_duration' => $service->video_duration ?? '',
            'inclusions_text' => implode("\n", $service->inclusions ?? []),
            'is_active' => $service->is_active,
            'sort_order' => $service->sort_order,
        ];

        $this->showModal = true;
    }

    public function saveService(): void
    {
        $validated = $this->validate([
            'form.event_type' => [
                'required',
                'string',
                'max:100',
            ],
            'form.name' => [
                'required',
                'string',
                'max:150',
            ],
            'form.service_type' => [
                'required',
                Rule::in([
                    'Photography',
                    'Videography',
                    'Photo + Video',
                ]),
            ],
            'form.description' => [
                'nullable',
                'string',
            ],
            'form.price' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'form.coverage_hours' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'form.photographer_count' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'form.videographer_count' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'form.edited_photo_count' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'form.video_duration' => [
                'nullable',
                'string',
                'max:100',
            ],
            'form.inclusions_text' => [
                'nullable',
                'string',
            ],
            'form.is_active' => [
                'boolean',
            ],
            'form.sort_order' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $data = $validated['form'];

        $inclusions = collect(
            preg_split('/\r\n|\r|\n/', $data['inclusions_text'] ?? '')
        )
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();

        $serviceData = [
            'event_type' => $data['event_type'],
            'name' => $data['name'],
            'service_type' => $data['service_type'],
            'description' => $data['description'] ?: null,
            'price' => $data['price'],
            'coverage_hours' => $data['coverage_hours'] ?: null,
            'photographer_count' => $data['photographer_count'] ?: null,
            'videographer_count' => $data['videographer_count'] ?: null,
            'edited_photo_count' => $data['edited_photo_count'] ?: null,
            'video_duration' => $data['video_duration'] ?: null,
            'inclusions' => $inclusions,
            'is_active' => $data['is_active'],
            'sort_order' => $data['sort_order'],
        ];

        if ($this->serviceId) {
            Service::findOrFail($this->serviceId)->update($serviceData);
        } else {
            Service::create($serviceData);
        }

        $this->showModal = false;
        $this->serviceId = null;

        $this->resetValidation();

        session()->flash(
            'success',
            'Service package saved successfully.'
        );
    }

    public function toggleStatus(int $id): void
    {
        $service = Service::findOrFail($id);

        $service->update([
            'is_active' => ! $service->is_active,
        ]);
    }

    public function deleteService(int $id): void
    {
        Service::findOrFail($id)->delete();

        session()->flash(
            'success',
            'Service package deleted successfully.'
        );
    }

    public function getServicesProperty()
    {
        return Service::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
