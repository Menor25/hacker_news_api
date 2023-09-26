<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Jobs\SpoolStories;
use App\Models\NewStoryId;
use Illuminate\Http\Request;
use App\Services\StoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class StoryController extends Controller
{

    public function __construct(StoryService $storyService)
    {
        $this->storyService = $storyService;
    }


    //Spool stories
    public function spoolStories()
    {
        dispatch(new SpoolStories($this->storyService));
        return new JsonResponse([
            'message' => 'Spooling stories in progress'
        ]);
    }

    // Get a list of all stories
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 20;
        $stories = Story::query()->paginate($page_size);

        return new JsonResponse([
            'data' => $stories
        ]);
    }

    // Get a specific story by ID
    public function show(Request $request)
    {
        $singleStory = Story::find($request->id);

        if (!$singleStory) {
            return new JsonResponse([
                'message' => 'Story not found'
            ], 404);
        };
        return new JsonResponse([
            'data' => $singleStory
        ]);

    }


}
