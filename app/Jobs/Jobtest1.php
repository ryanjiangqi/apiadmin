<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Article;

class Jobtest1 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->onQueue('job_queue');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Article $article)
    {
        $article->name = 'test';
        $article->created_at = date('Y-m-d H:i:s');
        $article->save();


    }

    public function failed(Exception $exception)
    {
        // 给用户发送失败的通知等等...
    }
}
