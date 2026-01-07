<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rating' => (int) $this->rating_score,
            'comment' => $this->comment,
            'detailed_scores' => [
                'professionalism' => $this->professionalism_score,
                'quality' => $this->quality_score,
                'communication' => $this->communication_score,
            ],
            // Data Reviewer (Client)
            'reviewer' => [
                'name' => $this->reviewer->name,
                // Fallback ke avatar default jika foto tidak ada
                'avatar' => $this->reviewer->profile_photo_url
                    ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->reviewer->name),
            ],
            // Respon dari Brand
            'brand_reply' => $this->reply_comment ? [
                'comment' => $this->reply_comment,
                'replied_at' => $this->replied_at->diffForHumans(),
            ] : null,
            'created_at' => $this->created_at->format('d M Y'),
            'relative_time' => $this->created_at->diffForHumans(),
        ];
    }
}
