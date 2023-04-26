<?php

namespace App\Services;


use App\Http\Requests\Author\PostRequest;

class AuthorFilterService extends FilterServiceBase
{
    public function getAvailableFilters(): array
    {
        return (new PostRequest())->rules();
    }

    public function getStrictFilters(): array
    {
        return ['user_id'];
    }

    public function getAdditionalStrictFilters(): array
    {
        return ['id'];
    }
}