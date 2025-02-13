<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteExpiredStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stories:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete stories that have expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredStories = Story::where('expires_at', '<', now())->get();

        foreach ($expiredStories as $story) {
            // Delete the media file
            Storage::disk('public')->delete($story->media_url);
            // Delete the story record
            $story->delete();
        }

        $this->info('Expired stories have been deleted.');
    }
}
