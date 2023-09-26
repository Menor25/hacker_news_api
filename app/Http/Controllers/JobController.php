<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Jobs\SpoolJobs;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    protected $jobService;
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function spoolJobStories()
    {
        dispatch(new SpoolJobs($this->jobService));
        return new JsonResponse([
            'message' => 'Spooling job stories in progress'
        ]);
    }

     // Get a list of all ask stories
     public function index(Request $request)
     {
         $page_size = $request->page_size ?? 20;
         $job_stories = Job::query()->paginate($page_size);

         return new JsonResponse([
             'data' => $job_stories
         ]);
     }

     // Get a specific Job story by ID
     public function show(Request $request)
     {
         $jobStory = Job::find($request->id);

         if (!$jobStory) {
             return new JsonResponse([
                 'message' => 'Story not found'
             ], 404);
         };
         return new JsonResponse([
             'data' => $jobStory
         ]);

     }
}
