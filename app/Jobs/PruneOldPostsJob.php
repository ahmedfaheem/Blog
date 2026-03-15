<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
class PruneOldPostsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Starting PruneOldPostsJob...");

        $posts = Post::whereDate('created_at', '<=',now()->subYears(2))->get();
        foreach ($posts as $post) {
            $post->comments()->delete();
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->delete();
        }

    }
}
