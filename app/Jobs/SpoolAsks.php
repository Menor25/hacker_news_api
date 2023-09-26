<?php

namespace App\Jobs;

use App\Services\AskService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SpoolAsks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $askService;

    //Injecting the ask service into the constructor
    public function __construct(AskService $askService)
    {
        $this->askService = $askService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->askService->getAndStoreAsk();
        } catch (\Exception $e) {
            // Log the exception
            Log::debug('SpoolAskStories job failed: ' . $e->getMessage());
        }
    }


}
