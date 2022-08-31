<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\MakeTotalReportNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeTotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sections;
    public $user;

    public function __construct(User $user, $sections)
    {
        $this->sections = $sections;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $res = [];
        $namespace = "App\Models";

        if ($this->sections)
        {
            foreach ($this->sections as $section) {
                $res[$section] = ($namespace . '\\'. $section)::count();
            }

            $this->user->notify(new MakeTotalReportNotification($res));
        }
    }
}
