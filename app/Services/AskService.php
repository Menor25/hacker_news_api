<?php

namespace App\Services;

use App\Models\Ask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class AskService
{

   private $ask_stories_ids_url = 'https://hacker-news.firebaseio.com/v0/askstories.json?print=pretty';

    private function getAskStoriesIds() {
        //Getting ask stories ids from the Hacker news api
        $res = Http::get($this->ask_stories_ids_url);
        if ($res) {
            //Coverting the Ids to json and returning the ids
            $ask_stories_ids = $res->json();

                return $ask_stories_ids;
        }
    }

    public function getAndStoreAsk()
    {
        // This Function returns an array of story IDs
        $ask_story_ids = $this->getAskStoriesIds();

        //Check if the IDs is not empty
        if (!empty($ask_story_ids)) {

            //Looping through the IDs to get a single ID
            foreach ($ask_story_ids as $ask_story_id) {
                //Using the resulted ID to get ask story from the hacker news api
                $response = Http::get("https://hacker-news.firebaseio.com/v0/item/{$ask_story_id}.json?print=pretty");

                if ($response->successful()) {
                    $data = $response->json();

                    //Checking for duplicate and storing the stories in the database if no duplicate
                    if (!$this->duplicateAsk($data['id'])) {
                        $ask = new Ask;
                        $ask->by = $data['by'];
                        $ask->descendants = $data['descendants'] ?? 0;
                        $ask->ask_id = $data['id'];
                        $ask->kids = json_encode($data['kids'] ?? []);
                        $ask->score = $data['score'] ?? 0;
                        $ask->text = $data['text'] ?? '';
                        $ask->time = $data['time'] ?? 0;
                        $ask->title = $data['title'] ?? '';
                        $ask->type = $data['type'] ?? '';

                        $ask->save();
                    }else {
                        return new JsonResponse([
                            'message' => 'Duplicate ask story'
                        ]);
                    }
                }
            }

            return new JsonResponse([
                'message' => 'All Ask stories fetched and stored successfully'
            ]);
        }

        return new JsonResponse([
            'message' => 'No Ask stories to fetch or store'
        ]);
    }

    private function duplicateAsk($ask_id)
    {

        return Ask::where('ask_id', $ask_id)->exists();
    }
}
