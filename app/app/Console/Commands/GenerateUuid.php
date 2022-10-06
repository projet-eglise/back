<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateUuid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:uuid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an uuid';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(Str::uuid()->toString());
        return 0;
    }
}
