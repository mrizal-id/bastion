<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\BrandRatingSummary;
use Illuminate\Support\Facades\DB;

class ReviewObserver
{
    public function saved(Review $review)
    {
        $this->updateSummary($review->brand_id);
    }

    public function deleted(Review $review)
    {
        $this->updateSummary($review->brand_id);
    }

    protected function updateSummary($brandId)
    {
        // Hitung ulang rata-rata dan total
        $stats = DB::table('reviews')
            ->where('brand_id', $brandId)
            ->where('is_hidden', false)
            ->selectRaw('COUNT(*) as total, AVG(rating_score) as avg')
            ->first();

        // Update atau Create di tabel summary
        BrandRatingSummary::updateOrCreate(
            ['brand_id' => $brandId],
            [
                'average_rating' => $stats->avg ?? 0,
                'total_reviews' => $stats->total ?? 0,
                'last_updated' => now()
            ]
        );
    }

    public function restored(Review $review)
    {
        $this->updateSummary($review->brand_id);
    }
}
