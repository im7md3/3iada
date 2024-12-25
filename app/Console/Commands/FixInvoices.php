<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class FixInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $invoices = Invoice::where('tax', '>', 0)->get();

        foreach ($invoices as $invoice) {
            $discount = ($invoice->discount + $invoice->offers_discount);
            $amount = $invoice->products->sum('price');
            $tax = $amount * (setting()->tax_rate / 100);
            $total = $amount + $tax;
            if ($discount) {
                $totalPaid = $total - $discount; // bacause bug in paid amount after tax fixed and by looking into invoices randomly, all discounted invoices are fully paid
                $cash = $invoice->cash ? $totalPaid : 0;
                $bank = $invoice->bank ? $totalPaid : 0;
                $card = $invoice->card ? $totalPaid : 0;
                $rest = 0;
            } else {
                $totalPaid = $invoice->cash + $invoice->card + $invoice->bank - $discount;
                $cash = $invoice->cash ? $invoice->cash : 0;
                $bank = $invoice->bank ? $invoice->bank : 0;
                $card = $invoice->card ? $invoice->card : 0;
                $rest = $total - $totalPaid;
            }
            $paidTax = $totalPaid  - ($totalPaid * 100) / (100 + setting()->tax_rate);
            $paidWithoutTax = $totalPaid - $paidTax;

            $invoice->update([
                'amount' => $amount,
                'tax' => $tax,
                'total' => $total,
                'paid_tax' => $paidTax,
                'paid_without_tax' => $paidWithoutTax,
                'rest' => $rest,
                'cash' => $cash,
                'bank' => $bank,
                'card' => $card
            ]);
        }
        /* $invoices = Invoice::get();

        foreach ($invoices as $invoice) {
            if ($invoice->patient->country_id == 1) {
                $invoice->update([
                    'tax' => 0
                ]);
            }
        } */
    }
}
