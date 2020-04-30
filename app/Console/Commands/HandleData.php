<?php

namespace App\Console\Commands;

use FuseSource\Stomp\Stomp;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class HandleData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:data {type=0}';

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
     * @return mixed
     */
    public function handle()
    {
        $argument = $this->argument('type');
        try {
            $connect = new Stomp('tcp://127.0.0.1:61613');
            switch ($argument){
                case 1:
                    $connect->clientId = 123;
                    break;
                case 2:
                    $connect->clientId = 234;
                    break;
                case 3:
                    $connect->clientId = 345;
                    break;
                case 4:
                    $connect->clientId = 456;
                    break;
                default:
                    $connect->clientId = 123456;
                    break;
            }
            $connect->connect('user', '666');//连接
            $connect->subscribe('/topic/demo1');//选择队列
            while (true){
                if ($connect->hasFrameToRead()){
                    $frame = $connect->readFrame();
                    dump($frame->body);
                    $connect->ack($frame);//始终是异步的
                }
                sleep(1);
            }
        } catch (\Exception $exception){
            info("aaa", [
                'message' => $exception->getMessage()
            ]);
        }
    }
}
