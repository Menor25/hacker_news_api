<?php

namespace App\Http\Controllers;

use App\Models\Ask;
use App\Jobs\SpoolAsks;
use App\Services\AskService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AskController extends Controller
{
    protected $askService;
    public function __construct(AskService $askService)
    {
        $this->askService = $askService;
    }

    public function spoolAskStories()
    {
        dispatch(new SpoolAsks($this->askService));
        return new JsonResponse([
            'message' => 'Spooling askes stories in progress'
        ]);
    }

    // Get a list of all ask stories
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 20;
        $ask_stories = Ask::query()->paginate($page_size);

        return new JsonResponse([
            'data' => $ask_stories
        ]);
    }

    // Get a specific ask story by ID
    public function show(Request $request)
    {
        $askStory = Ask::find($request->id);

        if (!$askStory) {
            return new JsonResponse([
                'message' => 'Story not found'
            ], 404);
        };
        return new JsonResponse([
            'data' => $askStory
        ]);

    }

}
