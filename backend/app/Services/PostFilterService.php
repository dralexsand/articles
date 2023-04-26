<?php

namespace App\Services;

use App\Http\Requests\Post\PostRequest;

class PostFilterService extends FilterServiceBase
{
    public function getAvailableFilters(): array
    {
        return (new PostRequest())->rules();
    }

    public function getStrictFilters(): array
    {
        return ['author_id'];
    }

    public function getAdditionalNoStrictFilters(): array
    {
        return ['created_at', 'updated_at'];
    }

    public function getAdditionalStrictFilters(): array
    {
        return ['id'];
    }
}