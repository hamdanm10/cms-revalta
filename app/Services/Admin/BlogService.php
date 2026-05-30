<?php

namespace App\Services\Admin;

use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogService
{
    public function store(array $data): Blog
    {
        return Blog::create([
            'category_id'       => $data['category_id'],
            'title'             => $data['title'],
            'slug'              => $data['slug'],
            'thumbnail'         => $this->uploadThumbnail($data['thumbnail']),
            'short_description' => $data['short_description'],
            'keywords'          => $data['keywords'],
            'content'           => clean($data['content'], 'quill_blog'),
            'status'            => $data['status'],
            'published_at'      => $data['status'] === 'published' ? now() : null,
        ]);
    }

    public function update(Blog $blog, array $data): Blog
    {
        $thumbnail = $blog->thumbnail;

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            Storage::disk('public')->delete($this->storagePath($thumbnail));
            $thumbnail = $this->uploadThumbnail($data['thumbnail']);
        }

        $publishedAt = $blog->published_at;
        if ($data['status'] === 'published' && $publishedAt === null) {
            $publishedAt = now();
        } elseif ($data['status'] === 'draft') {
            $publishedAt = null;
        }

        $blog->update([
            'category_id'       => $data['category_id'],
            'title'             => $data['title'],
            'slug'              => $data['slug'],
            'thumbnail'         => $thumbnail,
            'short_description' => $data['short_description'],
            'keywords'          => $data['keywords'],
            'content'           => clean($data['content'], 'quill_blog'),
            'status'            => $data['status'],
            'published_at'      => $publishedAt,
        ]);

        return $blog;
    }

    public function destroy(Blog $blog): void
    {
        Storage::disk('public')->delete($this->storagePath($blog->thumbnail));
        $blog->delete();
    }

    public function storeImage(UploadedFile $file): string
    {
        return $file->store('blogs/images', 'public');
    }

    private function uploadThumbnail(UploadedFile $file): string
    {
        $path = $file->store('blogs', 'public');

        return Storage::disk('public')->url($path);
    }

    private function storagePath(string $url): string
    {
        return Str::after($url, Storage::disk('public')->url(''));
    }
}
