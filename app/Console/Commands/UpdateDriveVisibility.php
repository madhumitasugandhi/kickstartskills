<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateDriveVisibility extends Command
{
    protected $signature = 'drives:update-visibility';
    protected $description = 'Make drives visible 30 mins before exam';

    public function handle()
    {
        $updated = DB::table('drive_visible_students')
            ->where('is_visible', 0)
            ->where('visible_at', '<=', now())
            ->update(['is_visible' => 1]);

        $this->info("Updated {$updated} drives visibility.");
    }
}