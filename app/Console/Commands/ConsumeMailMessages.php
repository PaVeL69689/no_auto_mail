<?php
namespace App\Console\Commands;

use App\Jobs\DeleteNotification;
use App\Jobs\SendNotificationEmail;
use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use App\Mail\RecommendationMail;


use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class ConsumeMailMessages extends Command
{
    protected $signature = 'kafka:consume-mail';
    protected $description = 'Consume email messages from Kafka';
    public function handle()
    {
        $consumer = Kafka::consumer(['mail-topic'], 'mail-group', 'kafka:9092')
        ->withOptions([
            'auto.offset.reset' => 'earliest',
            'enable.auto.commit' => 'false',
        ])->withHandler(function($message, $consumer) {
                try {
                    $body = json_decode($message->getBody());


                    if(isset($body->user) && $body->type == 'request'){
                        Queue::push(new SendNotificationEmail($body->user));
                        $consumer->commit($message);
                        $this->info('666');
                    }
                    if($body->type == 'delete'){
                        Queue::push(new DeleteNotification());
                        $consumer->commit($message);
                    }
                    
                } 
                catch (Exception $e) {
                    Log::channel('stderr')->error('ОШИБКА в Consume:email: ' . $e->getMessage());
                    $this->error("Failed to send email: " . $e->getMessage());
                }
            })->build();
        $consumer->consume();
    }
}