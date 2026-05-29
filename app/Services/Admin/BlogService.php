<?php

namespace App\Services\Admin;

use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
            'content'           => clean($data['content'], 'quill_blog'),
            'status'            => $data['status'],
            'published_at'      => $data['status'] === 'published' ? now() : null,
        ]);
    }

    public function update(Blog $blog, array $data): Blog
    {
        $thumbnail = $blog->thumbnail;

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            Storage::disk('public')->delete($thumbnail);
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
            'content'           => clean($data['content'], 'quill_blog'),
            'status'            => $data['status'],
            'published_at'      => $publishedAt,
        ]);

        return $blog;
    }

    public function destroy(Blog $blog): void
    {
        $blog->delete();
    }

    public function storeImage(UploadedFile $file): string
    {
        return $file->store('blogs/images', 'public');
    }

    private function uploadThumbnail(UploadedFile $file): string
    {
        return $file->store('blogs', 'public');
    }
}
