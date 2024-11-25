<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCheckoutMail;
use Illuminate\Support\Facades\Log;
use App\Models\UserOrder;
class OrderCheckoutJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data=UserOrder::with('orderItems','orderItems.ColorSize','orderItems.ColorSize.product','orderItems.ColorSize.image','orderItems.ColorSize.inventory','orderItems.ColorSize.color')->find($data);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::info(222222);
        Mail::to('boss@gmail.com')->send(new OrderCheckoutMail($this->data));
    }
}
