<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationEmail;
use App\ModelClickhouse\Card;
use App\Models\CarCard;
use Exception;
use Illuminate\Support\Facades\Queue;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    public function index(){

        // Queue::push(new SendNotificationEmail('1001'));
        // $data = (new Card)->get('2');

        // dd($data);
        
    }
    public function postgre(){
        try {

            $data = CarCard::where('id',1)->first();
            
            return response()->json([
                'status' => 'success',
                'database' => 'PostgreSQL',
                'version' => $data,
                'connection' => 'OK'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'database' => 'PostgreSQL',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
