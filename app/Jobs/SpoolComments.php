<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\CommentService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SpoolComments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $commentService;
    /**
     * Create a new job instance.
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        this->commentService->getAndStoreComments();
    }
}
