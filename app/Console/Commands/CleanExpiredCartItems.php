<?php

namespace App\Console\Commands;

use App\Models\CartItem;
use Illuminate\Console\Command;

class CleanExpiredCartItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:clean-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete cart items that are expired (expires_at < now)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = CartItem::where('expires_at', '<', now())->delete();
        $this->info("Deleted {$count} expired cart items.");
    }
}
