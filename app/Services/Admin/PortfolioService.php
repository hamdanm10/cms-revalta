<?php

namespace App\Services\Admin;

use App\Models\Portfolio;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            Storage::disk('public')->delete($this->storagePath($thumbnail));
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
        Storage::disk('public')->delete($this->storagePath($portfolio->thumbnail));
        $portfolio->delete();
    }

    private function uploadThumbnail(UploadedFile $file): string
    {
        $path = $file->store('portfolios', 'public');

        return Storage::disk('public')->url($path);
    }

    private function storagePath(string $url): string
    {
        return Str::after($url, Storage::disk('public')->url(''));
    }
}
