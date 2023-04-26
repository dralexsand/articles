<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{

    public $resource;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'posts' => $this->collection,
            'pagination' => $this->getPagination(),
        ];
    }

    protected function getPagination(): array
    {
        return [
            'perPage' => $this->resource->perPage(),
            'currentPage' => $this->resource->currentPage(),
            'path' => $this->resource->path(),
            'pageName' => 'page',
            'total' => $this->resource->total(),
            'lastPage' => $this->resource->lastPage(),
        ];
    }
}
