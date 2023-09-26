<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class JobService
{

   private $job_stories_ids_url = 'https://hacker-news.firebaseio.com/v0/jobstories.json?print=pretty';

    private function getJobStoriesIds() {
        //Getting job stories ids from the Hacker news api
        $res = Http::get($this->job_stories_ids_url);
        if ($res) {
            //Coverting the Ids to json and returning the ids
            $job_stories_ids = $res->json();

                return $job_stories_ids;
        }
    }

    public function getAndStoreJobs()
    {
        // This Function returns an array of job story IDs
        $job_story_ids = $this->getJobStoriesIds();

        //Check if the IDs is not empty
        if (!empty($job_story_ids)) {

            //Looping through the IDs to get a single ID
            foreach ($job_story_ids as $job_story_id) {
                //Using the resulted ID to get job story from the hacker news api
                $response = Http::get("https://hacker-news.firebaseio.com/v0/item/{$job_story_id}.json?print=pretty");

                if ($response->successful()) {
                    $data = $response->json();

                    //Checking for duplicate and storing the stories in the database if no duplicate
                    if (!$this->duplicateJob($data['id'])) {
                        $job = new Job;
                        $job->by = $data['by'];
                        $job->job_id = $data['id'];
                        $job->score = $data['score'] ?? 0;
                        $job->time = $data['time'] ?? 0;
                        $job->title = $data['title'] ?? '';
                        $job->type = $data['type'] ?? '';
                        $job->url = $data['url'] ?? '';

                        $job->save();
                    }else {
                        return new JsonResponse([
                            'message' => 'Duplicate job story'
                        ]);
                    }
                }
            }

            return new JsonResponse([
                'message' => 'All Job stories fetched and stored successfully'
            ]);
        }

        return new JsonResponse([
            'message' => 'No Job stories to fetch or store'
        ]);
    }

    private function duplicateJob($job_id)
    {

        return Job::where('job_id', $job_id)->exists();
    }
}
