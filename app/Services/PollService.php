<?php

namespace App\Services;

use App\Models\Poll;
use Illuminate\Support\Facades\Http;

class PollService
{
    public function getAndStorePolls()
    {
        // Fetching Polls data from Hacker News API
        $res = Http::get('https://hackernews.api.com/stories');

        if ($res->ok()) {
            $data = $res->json();

            foreach ($data as $poll) {
                //Perform Validation
                //Check if the polls already exists in the database
                if (!$this->duplicatePoll($poll['id'])) {
                    // Create a new Poll model instance and save it to the database
                    Poll::create([
                        'id' => $poll['id'],
                        'by' => $poll['by'],
                        'descendants' => $poll['descendants'],
                        'kids' => $poll['kids'],
                        'parts' => $poll['parts'],
                        'score' => $poll['score'],
                        'text' => $poll['text'],
                        'time' => $poll['time'],
                        'title' => $poll['title'],
                        'type' => $poll['type']
                    ]);
                }
            }
        }
    }

    private function duplicatePoll($poll_Id)
    {
        return Poll::where('id', $poll_Id)->exists();
    }
}
