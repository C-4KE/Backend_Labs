<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;

class CountAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:count-addresses {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command returns a number of customer\'s addresses.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customerID = $this->argument('id');
        $customer = Customer::find($customerID);
        if ($customer == null) {
            $this->info('There are no customers with this id in database.');
        } else {

            $this->info('Number of addresses: '.count($customer->addresses()->get()));
        }
    }
}
