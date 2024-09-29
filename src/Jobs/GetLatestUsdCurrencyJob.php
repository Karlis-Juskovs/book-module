<?php

namespace Karlis\Module2\Jobs;

use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Karlis\Module2\Models\Currency;

class GetLatestUsdCurrencyJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();

        try {
            $url = 'https://www.bank.lv/vk/ecb.csv'; // today's exchange rates in CSV format
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }

        if (isset($content)) {
            $lines = array_filter(array_map('trim', explode("\n", $content)));

            foreach ($lines as $line) {
                [$currency, $rate] = explode("\t", $line);

                if ($currency === 'USD' ) {
                    if (is_numeric($rate) && $rate >= 0 && $rate <= 99) {
                        $usdCurrencyRate = $rate;
                    }
                }
            }

            if (isset($usdCurrencyRate)) {
                Currency::create([
                   'eur_rate' => 1, // base
                   'usd_rate' => $usdCurrencyRate,
                ]);
            }
        }
    }
}
