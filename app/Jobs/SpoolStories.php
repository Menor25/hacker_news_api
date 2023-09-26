<?php

namespace App\Jobs;

use App\Models\Story;
use Illuminate\Bus\Queueable;
use App\Services\StoryService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SpoolStories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $storyService;

    //Injecting the story service into the constructor
    public function __construct(StoryService $storyService)
    {
        $this->storyService = $storyService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->storyService->getAndStoreStories();
        } catch (\Exception $e) {
            // Log the exception
            Log::debug('SpoolStories job failed: ' . $e->getMessage());
        }

    }

}
