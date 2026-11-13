
<x-filament-panels::page>
    @php
        $images = $this->getGalleryImages();
        $featuredImages = $images->take(3);
        $otherImages = $images->skip(3);
    @endphp

    <div class="adv-gallery-admin">

        <div class="adv-gallery-heading">
            <div>
                <span class="adv-gallery-eyebrow">ADV-EDITS / PORTFOLIO</span>
                <h1>Gallery Management</h1>
                <p>Manage the photographs displayed in your customer gallery.</p>
            </div>

            <div class="adv-gallery-count">
                <strong>{{ $images->count() }}</strong>
                <span>Total Images</span>
            </div>
        </div>

        @if ($images->isEmpty())
            <div class="adv-gallery-empty">
                <div class="adv-gallery-empty-icon">📷</div>
                <h2>Your gallery is waiting</h2>
                <p>Start building your portfolio by uploading your first photograph.</p>
            </div>
        @else

            @if ($featuredImages->isNotEmpty())
                <section class="adv-gallery-section">
                    <div class="adv-gallery-section-heading">
                        <div>
                            <span>01 / HIGHLIGHTS</span>
                            <h2>Featured Collection</h2>
                        </div>
                    </div>

                    <div class="adv-featured-grid">
                        @foreach ($featuredImages as $image)
                            <article class="adv-gallery-card">
                                <div class="adv-gallery-photo">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image) }}"
                                        alt="{{ $image->title }}"
                                    >

                                    <span class="adv-gallery-status {{ $image->is_published ? 'is-published' : 'is-hidden' }}">
                                        {{ $image->is_published ? 'Published' : 'Hidden' }}
                                    </span>
                                </div>

                                <div class="adv-gallery-card-content">
                                    <span class="adv-gallery-category">
                                        {{ $image->category ?: 'Uncategorized' }}
                                    </span>

                                    <h3>{{ $image->title }}</h3>

                                    <p>
                                        {{ $image->description ?: 'No description added.' }}
                                    </p>

                                    <div class="adv-gallery-actions">
                                        <a
                                            href="{{ \App\Filament\Resources\Galleries\GalleryResource::getUrl('edit', ['record' => $image]) }}"
                                            class="adv-gallery-edit"
                                        >
                                            Edit Image
                                        </a>

                                        <button
                                            type="button"
                                            wire:click="togglePublished({{ $image->id }})"
                                            class="adv-gallery-toggle"
                                        >
                                            {{ $image->is_published ? 'Hide' : 'Publish' }}
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="deleteGallery({{ $image->id }})"
                                            wire:confirm="Are you sure you want to permanently delete this image?"
                                            class="adv-gallery-delete"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($otherImages->isNotEmpty())
                <section class="adv-gallery-section">
                    <div class="adv-gallery-section-heading">
                        <div>
                            <span>02 / PORTFOLIO</span>
                            <h2>All Other Photographs</h2>
                        </div>
                        <p>{{ $otherImages->count() }} more images</p>
                    </div>

                    <div class="adv-gallery-card-grid">
                        @foreach ($otherImages as $image)
                            <article class="adv-gallery-card">
                                <div class="adv-gallery-photo">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image) }}"
                                        alt="{{ $image->title }}"
                                    >

                                    <span class="adv-gallery-status {{ $image->is_published ? 'is-published' : 'is-hidden' }}">
                                        {{ $image->is_published ? 'Published' : 'Hidden' }}
                                    </span>
                                </div>

                                <div class="adv-gallery-card-content">
                                    <span class="adv-gallery-category">
                                        {{ $image->category ?: 'Uncategorized' }}
                                    </span>

                                    <h3>{{ $image->title }}</h3>

                                    <p>
                                        {{ $image->description ?: 'No description added.' }}
                                    </p>

                                    <div class="adv-gallery-actions">
                                        <a
                                            href="{{ \App\Filament\Resources\Galleries\GalleryResource::getUrl('edit', ['record' => $image]) }}"
                                            class="adv-gallery-edit"
                                        >
                                            Edit Image
                                        </a>

                                        <button
                                            type="button"
                                            wire:click="togglePublished({{ $image->id }})"
                                            class="adv-gallery-toggle"
                                        >
                                            {{ $image->is_published ? 'Hide' : 'Publish' }}
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="deleteGallery({{ $image->id }})"
                                            wire:confirm="Are you sure you want to permanently delete this image?"
                                            class="adv-gallery-delete"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

        @endif
    </div>

    <style>
        .adv-gallery-admin {
            color: #30251e;
            padding-bottom: 35px;
        }

        .adv-gallery-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 35px;
        }

        .adv-gallery-eyebrow,
        .adv-gallery-section-heading span {
            color: #967650;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .adv-gallery-heading h1 {
            color: #30251e;
            font-family: Georgia, serif;
            font-size: clamp(26px, 4vw, 38px);
            font-weight: 600;
            margin: 8px 0;
        }

        .adv-gallery-heading p,
        .adv-gallery-section-heading p {
            color: #85776b;
            font-size: 13px;
        }

        .adv-gallery-count {
            min-width: 105px;
            padding: 15px 20px;
            text-align: center;
            background: #fffaf3;
            border: 1px solid #e6d8c6;
            border-radius: 12px;
        }

        .adv-gallery-count strong,
        .adv-gallery-count span {
            display: block;
        }

        .adv-gallery-count strong {
            color: #967650;
            font-family: Georgia, serif;
            font-size: 27px;
        }

        .adv-gallery-count span {
            color: #85776b;
            font-size: 11px;
        }

        .adv-gallery-section {
            margin-top: 35px;
        }

        .adv-gallery-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 15px;
            margin-bottom: 18px;
        }

        .adv-gallery-section-heading h2 {
            color: #30251e;
            font-family: Georgia, serif;
            font-size: 25px;
            margin: 5px 0 0;
        }

        .adv-featured-grid,
        .adv-gallery-card-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .adv-gallery-card {
            overflow: hidden;
            background: #fffaf3;
            border: 1px solid #e8ded2;
            border-radius: 13px;
            box-shadow: 0 5px 18px rgba(48, 37, 30, .05);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .adv-gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(48, 37, 30, .12);
        }

        .adv-gallery-photo {
            position: relative;
            height: 230px;
            overflow: hidden;
            background: #e9dfd3;
        }

        .adv-gallery-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .adv-gallery-card:hover .adv-gallery-photo img {
            transform: scale(1.05);
        }

        .adv-gallery-status {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 11px;
            border-radius: 20px;
            color: white;
            font-size: 10px;
            font-weight: 700;
        }

        .adv-gallery-status.is-published {
            background: #486b4d;
        }

        .adv-gallery-status.is-hidden {
            background: #806b5c;
        }

        .adv-gallery-card-content {
            padding: 17px;
        }

        .adv-gallery-category {
            color: #a17e55;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .adv-gallery-card-content h3 {
            color: #30251e;
            font-family: Georgia, serif;
            font-size: 19px;
            margin: 8px 0;
        }

        .adv-gallery-card-content p {
            color: #85776b;
            font-size: 12px;
            line-height: 1.6;
            min-height: 38px;
            overflow-wrap: anywhere;
        }

        .adv-gallery-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            padding-top: 13px;
            border-top: 1px solid #eadfd2;
        }

        .adv-gallery-actions a,
        .adv-gallery-actions button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            padding: 7px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .adv-gallery-edit {
            background: #30251e;
            color: #fffaf3 !important;
        }

        .adv-gallery-edit:hover {
            background: #594332;
        }

        .adv-gallery-toggle {
            background: #eee3d5;
            color: #594332;
            border: 0;
        }

        .adv-gallery-toggle:hover {
            background: #dfc9ad;
        }

        .adv-gallery-delete {
            background: #f5e4df;
            color: #9b4539;
            border: 0;
        }

        .adv-gallery-delete:hover {
            background: #edcfc6;
        }

        .adv-gallery-empty {
            padding: 65px 20px;
            text-align: center;
            background: #fffaf3;
            border: 1px dashed #cbb69c;
            border-radius: 14px;
        }

        .adv-gallery-empty-icon {
            font-size: 42px;
            margin-bottom: 12px;
        }

        .adv-gallery-empty h2 {
            color: #30251e;
            font-family: Georgia, serif;
            font-size: 25px;
        }

        .adv-gallery-empty p {
            color: #85776b;
            font-size: 13px;
        }

        @media (max-width: 1024px) {
            .adv-featured-grid,
            .adv-gallery-card-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .adv-gallery-heading {
                align-items: flex-start;
            }

            .adv-gallery-count {
                min-width: 75px;
                padding: 10px;
            }

            .adv-featured-grid,
            .adv-gallery-card-grid {
                grid-template-columns: 1fr;
            }

            .adv-gallery-photo {
                height: 250px;
            }

            .adv-gallery-section-heading h2 {
                font-size: 21px;
            }
        }
    </style>
</x-filament-panels::page>
