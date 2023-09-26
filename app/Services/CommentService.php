<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Http;

class CommentService
{
    public function getAndStoreComments()
    {
        // Fetching Stories data from Hacker News API
        $res = Http::get('https://hackernews.api.com/stories');

        if ($res->ok()) {
            $data = $res->json();

            foreach ($data as $comment) {
                //Perform Validation
                //Check if the comment already exists in the database
                if (!$this->duplicateComment($comment['id'])) {
                    // Create a new Comment model instance and save it to the database
                    Comment::create([
                        'id' => $comment['id'],
                        'by' => $comment['by'],
                        'kids' => $comment['kids'],
                        'parent' => $comment['parent'],
                        'text' => $comment['text'],
                        'time' => $comment['time'],
                        'type' => $comment['type'],
                    ]);
                }
            }
        }
    }

    private function duplicateComment($comment_id)
    {

        return Comment::where('id', $comment_id)->exists();
    }
}
