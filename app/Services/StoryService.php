<?php

namespace App\Services;

use App\Models\Story;
use App\Models\NewStoryId;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class StoryService
{
    private $new_stories_ids_url = 'https://hacker-news.firebaseio.com/v0/newstories.json?print=pretty';

    private function getStoriesIds() {
        //Getting stories ids from the Hacker news api
        $res = Http::get($this->new_stories_ids_url);
        if ($res) {
            //Coverting the Ids to json and returning the ids
            $stories_ids = $res->json();

                return $stories_ids;
        }
    }

    public function getAndStoreStories()
    {
        // this function returns an array of story IDs
        $story_ids = $this->getStoriesIds();

        if (!empty($story_ids)) {
            // Limit to 100 stories or less if there are fewer available
            $storiesToFetch = min(count($story_ids), 100);

            //Looping and fetching 100 new stories
            for ($i = 0; $i < $storiesToFetch; $i++) {
                $story_id = $story_ids[$i];
                $response = Http::get("https://hacker-news.firebaseio.com/v0/item/{$story_id}.json?print=pretty");

                if ($response->successful()) {
                    $data = $response->json();

                    //Store the stories in the stories table if no duplicate found
                    if (!$this->duplicateStory($data['id'])) {
                        $story = new Story;
                        $story->by = $data['by'];
                        $story->story_id = $data['id'];
                        $story->descendants = $data['descendants'] ?? 0;
                        $story->kids = json_encode($data['kids'] ?? []);
                        $story->score = $data['score'] ?? 0;
                        $story->time = $data['time'] ?? '';
                        $story->title = $data['title'] ?? 0;
                        $story->type = $data['type'] ?? '';
                        $story->url = $data['url'] ?? '';

                        $story->save();
                    }else {
                        return new JsonResponse([
                            'message' => 'Duplicate story'
                        ]);
                    }
                }
            }

            return new JsonResponse([
                'message' => 'Up to 100 stories fetched and stored successfully'
            ]);
        }

        return new JsonResponse([
            'message' => 'No Stories to fetch or store'
        ]);
    }



    private function duplicateStory($story_Id)
    {

        return Story::where('story_id', $story_Id)->exists();
    }
}
