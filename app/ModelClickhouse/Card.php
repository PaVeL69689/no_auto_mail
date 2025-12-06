<?php
    namespace App\ModelClickhouse;
    use ClickHouseDB;

    class Card{

        protected $table = 'car_card';

        protected $connect = null;

        public function __construct() {
            $config = [
                'host' => env('CLICKHOUSE_HOST', 'clickhouse'),
                'port' => env('CLICKHOUSE_PORT', 8123),
                'username' => env('CLICKHOUSE_USERNAME', 'house'),
                'password' => env('CLICKHOUSE_PASSWORD', '5555'),
                'database' => env('CLICKHOUSE_DATABASE', 'clickhouse'),
                'https' => false
            ];

            $this->connect = new ClickHouseDB\Client($config);
            $this->connect->database($config['database']);
            $this->connect->setTimeout(1.5);      // 1 second , support only Int value
            $this->connect->setTimeout(10);       // 10 seconds
            $this->connect->setConnectTimeOut(5); // 5 seconds
            $this->connect->ping(true); // если не удается подключиться, возникает исключение
        }

        public function get($id){
            $data = $this->connect->select("SELECT * FROM $this->table WHERE `user_id`=$id");
            return $data->rows();
        }
        public function getAll(){
            $data = $this->connect->select("SELECT * FROM $this->table");
            return $data->rows();
        }
        public function delete($data){
            
            $id = (string)$data['id'];
            $model_id = (string)$data['model_id'];
            $drive_id = (string)$data['drive_id'];
            $transmission_id = (string)$data['transmission_id'];
            $bodywork_id = (string)$data['bodywork_id'];
            $color_id = (string)$data['color_id'];
            $mark_id = (string)$data['mark_id'];
            $engine_id = (string)$data['engine_id'];
            $user_id = (string)$data['user_id'];

            $this->connect->write("DELETE FROM $this->table
                 WHERE `id`=$id
                 AND `model_id`=$model_id
                 AND `drive_id`=$drive_id
                 AND `transmission_id`=$transmission_id
                 AND `bodywork_id`=$bodywork_id
                 AND `color_id`=$color_id
                 AND `mark_id`=$mark_id
                 AND `engine_id`=$engine_id
                 AND `user_id`=$user_id
            ");
        }
    }