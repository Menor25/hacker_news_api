<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SpoolPolls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pollService;
    /**
     * Create a new job instance.
     */
    public function __construct(PollService $pollService)
    {
        $this->pollService = $pollService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->pollService->getAndStorePolls();
    }
}
