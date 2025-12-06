<?php
namespace App\Jobs;

use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\ModelClickhouse\Card;
use App\Models\CarCard;

class DeleteNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    

    public function __construct()
    {

    }

    public function handle()
    {
        try {
            
            $cards = (new Card)->getAll();
            foreach($cards as $card){
                $cardSearch = CarCard::where('id', $card['id'])->first();
                if(empty($cardSearch) && !isset($cardSearch)){
                    (new Card)->delete($card);
                }
                else {
                    continue;
                }
            }

            Log::info('Notification sent successfully', [
                'job_id' => $this->job->getJobId(),
            ]);
            
        } catch (\Exception $e) {
            Log::error('Notification job failed', [
                'job_id' => $this->job->getJobId(),
                'error' => $e->getMessage(),
            ]);
            
            throw $e;
        }
    }
    
    public function failed(\Throwable $exception)
    {
        Log::critical('Notification job permanently failed', [

            'error' => $exception->getMessage(),

        ]);
        
    }
}