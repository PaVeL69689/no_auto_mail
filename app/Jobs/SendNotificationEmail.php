<?php
namespace App\Jobs;

use App\Mail\RecommendationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\ModelClickhouse\Card;
use App\Models\CarCard;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendNotificationEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        try {
            // Логируем начало обработки
            Log::info('Processing notification', [
                'job_id' => $this->job->getJobId(),
                'user_id' => $this->userId,
                'queue' => $this->queue
            ]);

            $data = (new Card)->get((string)$this->userId);
            $id = null;
            $result = [];
            foreach($data as $card){
                if($card['id'] != $id){
                    $result[] = CarCard::where('id', $card['id'])->first();
                    $id = $card['id'];
                }
                else {
                    continue;
                }

            }
            if(isset($result) && !empty($result)){
                $email = User::where('id', $this->userId)->first()->email;
                Mail::to($email)->send(new RecommendationMail($result));
            }

            Log::info('Notification sent successfully', [
                'job_id' => $this->job->getJobId(),
                'user_id' => $this->userId
            ]);
            
        } catch (\Exception $e) {
            Log::error('Notification job failed', [
                'job_id' => $this->job->getJobId(),
                'error' => $e->getMessage(),
            ]);
            
            // Пробрасываем исключение для retry
            throw $e;
        }
    }
    
    public function failed(\Throwable $exception)
    {
        // Критическая ошибка после всех попыток
        Log::critical('Notification job permanently failed', [
            'user_id' => $this->userId,
            'error' => $exception->getMessage(),
        ]);
    }
}