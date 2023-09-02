<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-games {time=24}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired games from the database';

    private Carbon $removeTime;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Removing games...');
        $this->removeTime = Carbon::now()->subHours($this->argument('time'));

        $this->runQuery();
        $this->info('Games removed!');
    }

    private function runQuery(): void
    {
        DB::delete(
            <<<SQL
                DELETE FROM game
                WHERE game.deleted_at IS NOT NULL AND game.deleted_at < '{$this->removeTime->toDateTimeString()}'
            SQL
        );
    }
}
