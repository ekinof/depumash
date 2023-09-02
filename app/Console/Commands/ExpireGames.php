<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enum\GameStatusEnum;
use App\Interfaces\Commands\TransactionalCommand;
use App\Traits\Commands\UseTransaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpireGames extends Command implements TransactionalCommand
{
    use UseTransaction;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-games {time=300}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire games that haven\'t been played for a dedicated period of time';

    private Carbon $expirationDate;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Expiring games...');
        $this->expirationDate = (new Carbon())->subSeconds((int) $this->argument('time'));

        $this->handleTransaction();
        $this->info('Games expired successfully');
    }

    private function runQuery(): void
    {
        $status = GameStatusEnum::EXPIRED->value;

        DB::update(
            <<<SQL
                UPDATE game
                SET deleted_at = now(), updated_at = now(), status = '{$status}'
                WHERE created_at < '{$this->expirationDate->toDateTimeString()}' AND deleted_at IS NULL
            SQL
        );
    }
}
