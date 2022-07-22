<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use App\Notifications\NewArticlesNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendNotifyToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendNotify {days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification about new articles to all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $days = (int) $this->argument('days');
        $articles = Article::whereDate('created_at', '>', Carbon::now()->subDays($days))->get();
        $users = User::all();

        $users->map->notify(new NewArticlesNotification($articles));

        return 0;
    }
}
