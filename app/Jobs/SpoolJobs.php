<?php

namespace App\Jobs;

use App\Services\JobService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SpoolJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $jobService;

    // Injecting the job service into the constructor
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->jobService->getAndStoreJobs();
    }
}
