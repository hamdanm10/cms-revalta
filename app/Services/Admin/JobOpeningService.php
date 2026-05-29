<?php

namespace App\Services\Admin;

use App\Models\JobOpening;

class JobOpeningService
{
    public function store(array $data): JobOpening
    {
        return JobOpening::create([
            'title'             => $data['title'],
            'short_description' => $data['short_description'],
            'description'       => clean($data['description'], 'quill'),
            'work_type'         => $data['work_type'],
            'status'            => $data['status'],
            'slug'              => $data['slug'],
        ]);
    }
}
