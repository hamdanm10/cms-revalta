<?php

namespace App\Services\Admin;

use App\Models\Portfolio;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    public function store(array $data): Portfolio
    {
        return Portfolio::create([
            'category_id'       => $data['category_id'],
            'title'             => $data['title'],
            'short_description' => $data['short_description'],
            'description'       => clean($data['description'], 'quill'),
            'thumbnail'         => $this->uploadThumbnail($data['thumbnail']),
            'slug'              => $data['slug'],
            'status'            => $data['status'],
        ]);
    }

    public function update(Portfolio $portfolio, array $data): Portfolio
    {
        $thumbnail = $portfolio->thumbnail;

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            Storage::disk('public')->delete($thumbnail);
            $thumbnail = $this->uploadThumbnail($data['thumbnail']);
        }

        $portfolio->update([
            'category_id'       => $data['category_id'],
            'title'             => $data['title'],
            'short_description' => $data['short_description'],
            'description'       => clean($data['description'], 'quill'),
            'thumbnail'         => $thumbnail,
            'slug'              => $data['slug'],
            'status'            => $data['status'],
        ]);

        return $portfolio;
    }

    public function destroy(Portfolio $portfolio): void
    {
        $portfolio->delete();
    }

    private function uploadThumbnail(UploadedFile $file): string
    {
        return $file->store('portfolios', 'public');
    }
}
