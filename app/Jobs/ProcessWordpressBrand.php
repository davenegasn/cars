<?php

namespace App\Jobs;

use App\Api\WordPressApi;
use App\Models\Brand;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessWordpressBrand implements ShouldQueue
{
    use Batchable; 
    use Queueable;
    use SerializesModels;

   
   

    public $tries = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(public $brand)
    { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //$brand = Brand::find($this->brandId);
       
        Log::info('Processing WordPress brand');

        if ($this->brand->wp_id) {
            Log::info('Brand already exists in WordPress: ' . $this->brand->wp_id);
            return;
        }

        $wpApi = new WordPressApi();

        try {
            $wpBrands = $wpApi->getBrands();
        } catch (\Exception $e) {
            Log::error('Failed to fetch brands from WordPress: ' . $e->getMessage());

            $this->release(120);
        }

        if (! $wpBrands->contains('id', $this->brand->wp_id)) {
            try {
                $newBrand = $wpApi->createBrand($this->brand);
                $this->brand->update(['wp_id' => $newBrand['id']]);
            } catch (\Exception $e) {
                Log::error('Failed to create brand in WordPress: ' . $e->getMessage());
               
                $this->release(120);
            }
        }
    }
}
