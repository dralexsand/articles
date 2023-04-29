<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\PostRequest;
use App\Http\Requests\Author\UpdateRequest;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorCollectionFiltered;
use App\Http\Resources\AuthorFilteredResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\AuthorFilterService;
use App\Services\FilterServiceInterface;
use App\Traits\ResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{

    use ResponseTrait;

    protected FilterServiceInterface $filterService;

    public function __construct(AuthorFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function list(): Response
    {
        $authors = Author::query()->get();

        $collect = AuthorFilteredResource::collection($authors);

        return $this->getResponse($collect, 200, 200, 'Resource not found');
    }

    public function index(): Response
    {
        $query = Author::query();

        $query = $this->filterService->getFilteredQuery($query);

        $authors = $query->paginate();

        $collect = new AuthorCollection($authors);

        return $this->getResponse($collect, 200, 200, 'Resource not found');
    }

    public function store(PostRequest $request): Response
    {
        $validated = $this->validate($request, $request->rules());
        $author = Author::create($validated);

        return $this->getResponse($author, 201, 200, 'Error created');
    }

    public function show(int $id): Response
    {
        $author = Author::find($id);

        if (!$author) {
            $resource = null;
        } else {
            $resource = new AuthorResource($author);
        }

        return $this->getResponse($resource, 200, 200, 'Resource not found');
    }

    public function update(UpdateRequest $request, string $id): Response
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->getResponse(null, 200, 200, 'Resource not found');
        }

        $validated = $this->validate($request, $request->rules());
        $authorUpdate = $author->update($validated);

        if ($authorUpdate) {
            $resource = new AuthorResource(Author::find($id));
            return $this->getResponse($resource, 201, 200, 'Error update');
        }
    }

    public function destroy(int $id): Response
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->getResponse($author, 200, 200, 'Resource not found');
        } else {
            $author->delete();
            return $this->getResponse("ID $id deleted", 200, 200, 'Error deleted');
        }
    }

}
