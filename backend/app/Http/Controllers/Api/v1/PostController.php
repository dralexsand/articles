<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\FilterServiceInterface;
use App\Services\PostFilterService;
use App\Traits\ResponseTrait;
use Symfony\Component\HttpFoundation\Response;


class PostController extends Controller
{
    use ResponseTrait;

    protected FilterServiceInterface $filterService;

    public function __construct(PostFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function index(): Response
    {
        $query = Post::query();

        $query = $this->filterService->getFilteredQuery($query);

        $posts = $query->paginate();

        $collect = new PostCollection($posts);

        return $this->getResponse($collect, 200, 200, 'Resource not found');
    }

    public function store(PostRequest $request): Response
    {
        $validated = $this->validate($request, $request->rules());
        $post = Post::create($validated);

        return $this->getResponse($post, 201, 200, 'Error created');
    }

    public function show(string $id): Response
    {
        $post = Post::find($id);

        if (!$post) {
            $resource = null;
        } else {
            $resource = new PostResource($post);
        }

        return $this->getResponse($resource, 200, 200, 'Resource not found');
    }

    public function update(UpdateRequest $request, string $id): Response
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->getResponse(null, 200, 200, 'Resource not found');
        }

        $validated = $this->validate($request, $request->rules());
        $postUpdate = $post->update($validated);

        if ($postUpdate) {
            $resource = new PostResource(Post::find($id));
            return $this->getResponse($resource, 201, 200, 'Error update');
        }
    }

    public function destroy(string $id): Response
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->getResponse($post, 200, 200, 'Resource not found');
        } else {
            $post->delete();
            return $this->getResponse("ID $id deleted", 200, 200, 'Error deleted');
        }
    }
}
