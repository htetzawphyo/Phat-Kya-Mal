<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class BookRequestNoti implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $bookRequestData;
    /**
     * Create a new job instance.
     */
    public function __construct($bookRequestData)
    {
        $this->bookRequestData = $bookRequestData;
    }
    
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->bookRequestData;
        
        HTTP::post('https://discord.com/api/webhooks/1185832973082308710/ysnJDqzw8pxTnYOnc7oweeZCTFw7OLRak8i4XZtP-vRoUJ40XVxmuJnHSydJVWPfn6gQ', [
            'content' => "Book Request",
            'embeds' => [
                [
                    'title' => $data['author_name'] ?? 'Unknown author',
                    'description' => $data['book_name'],
                    'color' => '7506394',
                ]
            ],
        ]);
    }
}
