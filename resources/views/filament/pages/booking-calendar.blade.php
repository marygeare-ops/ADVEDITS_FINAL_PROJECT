
<x-filament-panels::page>
    <style>
        .services-page {
            color: inherit;
            width: 100%;
        }

        .services-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 26px;
        }

        .services-subtitle {
            opacity: .65;
            font-size: 14px;
            margin-top: 5px;
        }

        .services-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 26px;
        }

        .services-stat,
        .service-card {
            border: 1px solid color-mix(in srgb, currentColor 13%, transparent);
            border-radius: 13px;
            background: color-mix(in srgb, white 65%, transparent);
            box-shadow: 0 2px 8px rgba(0,0,0,.035);
        }

        .dark .services-stat,
        .dark .service-card {
            background: rgba(255,255,255,.035);
        }

        .services-stat {
            padding: 21px;
        }

        .services-stat-label {
            font-size: 13px;
            opacity: .65;
        }

        .services-stat-number {
            font-size: 30px;
            font-weight: 750;
            margin-top: 7px;
            line-height: 1.2;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 19px;
        }

        .service-card {
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .service-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 9px 24px rgba(0,0,0,.08);
        }

        .service-card-top {
            height: 5px;
            background: var(--primary-600);
        }

        .service-card-content {
            padding: 21px;
        }

        .service-category {
            font-size: 11px;
            font-weight: 750;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: .65;
        }

        .service-name {
            font-size: 19px;
            font-weight: 750;
            line-height: 1.35;
            margin-top: 7px;
        }

        .service-status {
            font-size: 11px;
            font-weight: 700;
            border-radius: 20px;
            padding: 5px 10px;
            white-space: nowrap;
            background: rgba(22,163,74,.10);
            color: #15803d;
        }

        .service-status.inactive {
            background: rgba(107,114,128,.12);
            color: #6b7280;
        }

        .service-type {
            display: inline-flex;
            align-items: center;
            margin-top: 16px;
            border-radius: 7px;
            padding: 7px 11px;
            background: color-mix(in srgb, var(--primary-600) 10%, transparent);
            color: var(--primary-700);
            font-size: 12px;
            font-weight: 700;
        }

        .dark .service-type {
            color: var(--primary-300);
        }

        .service-price {
            font-size: 27px;
            font-weight: 800;
            margin-top: 17px;
            letter-spacing: -.7px;
        }

        .service-price-label {
            font-size: 11px;
            opacity: .55;
        }

        .service-description {
            font-size: 13px;
            opacity: .7;
            line-height: 1.65;
            margin-top: 13px;
        }

        .service-details {
            border-top: 1px solid color-mix(in srgb, currentColor 12%, transparent);
            margin-top: 17px;
            padding-top: 15px;
            display: grid;
            gap: 8px;
            font-size: 12px;
            opacity: .8;
        }

        .service-inclusions {
            margin-top: 17px;
        }

        .service-inclusions-title {
            font-size: 12px;
            font-weight: 750;
            margin-bottom: 9px;
        }

        .service-inclusion {
            display: flex;
            gap: 8px;
            font-size: 12px;
            margin-top: 7px;
            opacity: .8;
        }

        .service-actions {
            display: flex;
            gap: 8px;
            margin-top: 19px;
            padding-top: 15px;
            border-top: 1px solid color-mix(in srgb, currentColor 12%, transparent);
        }

        .service-action {
            flex: 1;
            border: 1px solid color-mix(in srgb, currentColor 16%, transparent);
            border-radius: 7px;
            padding: 8px 10px;
            font-size: 12px;
            font-weight: 650;
            text-align: center;
            cursor: pointer;
            background: transparent;
            color: inherit;
        }

        .service-action:hover {
            background: color-mix(in srgb, currentColor 7%, transparent);
        }

        .service-action.delete {
            color: #dc2626;
        }

        .services-empty {
            grid-column: 1 / -1;
            border: 1px dashed color-mix(in srgb, currentColor 25%, transparent);
            border-radius: 13px;
            padding: 55px 20px;
            text-align: center;
        }

        .services-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0,0,0,.58);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-y: auto;
        }

        .services-modal {
            background: #f8f4ee;
            color: #30251e;
            width: 100%;
            max-width: 760px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 14px;
            box-shadow: 0 20px 70px rgba(0,0,0,.25);
        }

        .dark .services-modal {
            background: #25201c;
            color: #f5eee7;
        }

        .services-modal-header,
        .services-modal-footer {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(120,90,65,.18);
        }

        .services-modal-footer {
            border-top: 1px solid rgba(120,90,65,.18);
            border-bottom: 0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .services-form {
            padding: 23px 25px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 17px;
        }

        .services-field.full {
            grid-column: 1 / -1;
        }

        .services-field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .services-field input,
        .services-field select,
        .services-field textarea {
            width: 100%;
            border: 1px solid #cfc4b8;
            background: rgba(255,255,255,.75);
            color: #30251e;
            border-radius: 7px;
            padding: 10px 12px;
            font-size: 13px;
        }

        .dark .services-field input,
        .dark .services-field select,
        .dark .services-field textarea {
            background: #302923;
            color: #fff;
            border-color: #5a4b40;
        }

        .services-field input:focus,
        .services-field select:focus,
        .services-field textarea:focus {
            outline: 2px solid var(--primary-500);
            outline-offset: 1px;
        }

        .services-primary-button {
            border: 0;
            border-radius: 8px;
            background: var(--primary-600);
            color: white;
            font-size: 13px;
            font-weight: 700;
            padding: 11px 17px;
            cursor: pointer;
        }

        .services-secondary-button {
            border: 1px solid #cfc4b8;
            border-radius: 8px;
            background: transparent;
            color: inherit;
            padding: 10px 16px;
            font-size: 13px;
            cursor: pointer;
        }

        .services-error {
            color: #dc2626;
            font-size: 11px;
            margin-top: 5px;
        }

        @media (max-width: 1050px) {
            .services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 650px) {
            .services-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .services-stats,
            .services-grid {
                grid-template-columns: 1fr;
            }

            .services-form {
                grid-template-columns: 1fr;
            }

            .services-field.full {
                grid-column: auto;
            }
        }
    </style>

    <div class="services-page">

        <div class="services-header">
            <div>
                <h2 style="font-size:24px;font-weight:800;letter-spacing:-.5px;">
                    Services & Packages
                </h2>
                <p class="services-subtitle">
                    Manage your photography and videography packages.
                </p>
            </div>

            <button type="button"
                wire:click="openCreateModal"
                class="services-primary-button">
                + Add New Package
            </button>
        </div>

        <div class="services-stats">
            <div class="services-stat">
                <div class="services-stat-label">Total Packages</div>
                <div class="services-stat-number">
                    {{ $this->services->count() }}
                </div>
            </div>

            <div class="services-stat">
                <div class="services-stat-label">Active Packages</div>
                <div class="services-stat-number">
                    {{ $this->services->where('is_active', true)->count() }}
                </div>
            </div>

            <div class="services-stat">
                <div class="services-stat-label">Inactive Packages</div>
                <div class="services-stat-number">
                    {{ $this->services->where('is_active', false)->count() }}
                </div>
            </div>
        </div>

        <div class="services-grid">
            @forelse ($this->services as $service)
                <article class="service-card" wire:key="service-{{ $service->id }}">
                    <div class="service-card-top"></div>

                    <div class="service-card-content">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:10px;">
                            <div>
                                <div class="service-category">
                                    {{ $service->event_type }}
                                </div>
                                <h3 class="service-name">
                                    {{ $service->name }}
                                </h3>
                            </div>

                            <span class="service-status {{ $service->is_active ? '' : 'inactive' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div class="service-type">
                            {{ $service->service_type }}
                        </div>

                        <div class="service-price">
                            ₱{{ number_format((float) $service->price, 2) }}
                        </div>
                        <div class="service-price-label">PACKAGE PRICE</div>

                        @if ($service->description)
                            <p class="service-description">
                                {{ $service->description }}
                            </p>
                        @endif

                        <div class="service-details">
                            @if ($service->coverage_hours)
                                <div>◷ &nbsp; {{ $service->coverage_hours }} hours coverage</div>
                            @endif

                            @if ($service->photographer_count)
                                <div>📷 &nbsp; {{ $service->photographer_count }} photographer(s)</div>
                            @endif

                            @if ($service->videographer_count)
                                <div>🎥 &nbsp; {{ $service->videographer_count }} videographer(s)</div>
                            @endif

                            @if ($service->edited_photo_count)
                                <div>✦ &nbsp; {{ $service->edited_photo_count }} edited photos</div>
                            @endif

                            @if ($service->video_duration)
                                <div>▶ &nbsp; Video duration: {{ $service->video_duration }}</div>
                            @endif
                        </div>

                        @if (count($service->inclusions ?? []))
                            <div class="service-inclusions">
                                <div class="service-inclusions-title">Package Inclusions</div>

                                @foreach ($service->inclusions as $inclusion)
                                    <div class="service-inclusion">
                                        <span style="color:#398451;font-weight:800;">✓</span>
                                        <span>{{ $inclusion }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="service-actions">
                            <button type="button"
                                class="service-action"
                                wire:click="openEditModal({{ $service->id }})">
                                Edit
                            </button>

                            <button type="button"
                                class="service-action"
                                wire:click="toggleStatus({{ $service->id }})">
                                {{ $service->is_active ? 'Deactivate' : 'Activate' }}
                            </button>

                            <button type="button"
                                class="service-action delete"
                                wire:click="deleteService({{ $service->id }})"
                                wire:confirm="Are you sure you want to delete this package?">
                                Delete
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="services-empty">
                    <div style="font-size:38px;margin-bottom:12px;">📷</div>
                    <h3 style="font-size:19px;font-weight:750;">
                        No packages yet
                    </h3>
                    <p style="font-size:13px;opacity:.65;margin-top:7px;">
                        Add your first photography or videography package.
                    </p>
                    <button type="button"
                        wire:click="openCreateModal"
                        class="services-primary-button"
                        style="margin-top:20px;">
                        + Add Your First Package
                    </button>
                </div>
            @endforelse
        </div>

        @if ($showModal)
            <div class="services-modal-overlay"
                wire:click.self="$set('showModal', false)">

                <div class="services-modal">
                    <div class="services-modal-header"
                        style="display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <h2 style="font-size:20px;font-weight:800;">
                                {{ $serviceId ? 'Edit Package' : 'Create New Package' }}
                            </h2>
                            <p style="font-size:12px;opacity:.65;margin-top:4px;">
                                Fill in the package information.
                            </p>
                        </div>

                        <button type="button"
                            wire:click="$set('showModal', false)"
                            style="font-size:25px;opacity:.6;">
                            &times;
                        </button>
                    </div>

                    <form wire:submit="saveService">
                        <div class="services-form">

                            <div class="services-field">
                                <label>Event Category *</label>
                                <select wire:model="form.event_type">
                                    <option>Wedding</option>
                                    <option>Birthday</option>
                                    <option>Debut</option>
                                    <option>Pre-Wedding / Prenup</option>
                                    <option>Graduation</option>
                                    <option>Corporate Event</option>
                                    <option>Other Special Occasion</option>
                                </select>
                                @error('form.event_type') <p class="services-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="services-field">
                                <label>Package Name *</label>
                                <input wire:model="form.name" type="text"
                                    placeholder="e.g. Wedding Premium Package">
                                @error('form.name') <p class="services-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="services-field">
                                <label>Service Type *</label>
                                <select wire:model="form.service_type">
                                    <option value="Photography">Photography</option>
                                    <option value="Videography">Videography</option>
                                    <option value="Photo + Video">Photo + Video</option>
                                </select>
                                @error('form.service_type') <p class="services-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="services-field">
                                <label>Package Price (₱) *</label>
                                <input wire:model="form.price" type="number"
                                    min="0.01" step="0.01" placeholder="8000.00">
                                @error('form.price') <p class="services-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="services-field full">
                                <label>Description</label>
                                <textarea wire:model="form.description" rows="3"
                                    placeholder="Describe what customers can expect..."></textarea>
                            </div>

                            <div class="services-field">
                                <label>Coverage Hours</label>
                                <input wire:model="form.coverage_hours" type="number" min="1">
                            </div>

                            <div class="services-field">
                                <label>Photographer Count</label>
                                <input wire:model="form.photographer_count" type="number" min="0">
                            </div>

                            <div class="services-field">
                                <label>Videographer Count</label>
                                <input wire:model="form.videographer_count" type="number" min="0">
                            </div>

                            <div class="services-field">
                                <label>Edited Photo Count</label>
                                <input wire:model="form.edited_photo_count" type="number" min="0">
                            </div>

                            <div class="services-field">
                                <label>Video Duration</label>
                                <input wire:model="form.video_duration" type="text"
                                    placeholder="e.g. 3-5 minutes">
                            </div>

                            <div class="services-field full">
                                <label>Package Inclusions</label>
                                <textarea wire:model="form.inclusions_text" rows="5"
                                    placeholder="One inclusion per line&#10;100 edited photos&#10;Online gallery&#10;USB copy"></textarea>
                                <p style="font-size:11px;opacity:.6;margin-top:5px;">
                                    Enter one inclusion per line.
                                </p>
                            </div>

                            <div class="services-field">
                                <label>Display Order</label>
                                <input wire:model="form.sort_order" type="number" min="0">
                            </div>

                            <div class="services-field" style="display:flex;align-items:center;gap:9px;padding-top:25px;">
                                <input wire:model="form.is_active" type="checkbox"
                                    style="width:16px;height:16px;">
                                <label style="margin:0;">Make package active</label>
                            </div>
                        </div>

                        <div class="services-modal-footer">
                            <button type="button"
                                wire:click="$set('showModal', false)"
                                class="services-secondary-button">
                                Cancel
                            </button>

                            <button type="submit"
                                wire:loading.attr="disabled"
                                class="services-primary-button">
                                <span wire:loading.remove wire:target="saveService">
                                    {{ $serviceId ? 'Save Changes' : 'Create Package' }}
                                </span>
                                <span wire:loading wire:target="saveService">
                                    Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</x-filament-panels::page>
