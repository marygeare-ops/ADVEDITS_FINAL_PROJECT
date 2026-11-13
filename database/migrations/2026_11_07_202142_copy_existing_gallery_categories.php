<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $categories = DB::table('galleries')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        foreach ($categories as $category) {
            $name = trim($category);

            if ($name === '') {
                continue;
            }

            DB::table('gallery_categories')->updateOrInsert(
                ['name' => $name],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        // Keep existing categories to avoid accidental data loss.
    }
};
