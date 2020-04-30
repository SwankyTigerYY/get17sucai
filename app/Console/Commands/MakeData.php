<?php

namespace App\Console\Commands;

use App\Jobs\Demo;
use FuseSource\Stomp\Stomp;
use Illuminate\Console\Command;

class MakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data {type=0} {--number=}';

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
        /*
        $argument = $this->argument();//获取单个参数
        $arguments = $this->arguments();//获取所有参数
        $option = $this->option();//获取单个选项
        $options = $this->options();//获取所有选项
        */
        //需要生成多少数据，不填写一直循环0
        $argument = $this->argument('type');
        $number = (int)$this->option('number');
        try {
            $connect=new Stomp('tcp://127.0.0.1:61613');
            $connect->connect('admin', 'admin');
            if ($number) {
                //有上限的for循环
                for ($i = 0; $i < $number; $i++) {
                    self::handleData($argument, $connect);
                }
            } else {
                //没有上限的while循环
                while (true) {
                    self::handleData($argument, $connect);
                }
            }
        } catch (\Exception $exception) {
            info('make-data', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * 数据处理
     * @param $type
     * @param $connect
     */
    public function handleData($type, $connect)
    {
        switch ($type){
            case 1:
                $route = '/topic/demo1';
                $data = [
                    'name' => 'demo1' . mt_rand(0,100)
                ];
                break;
            case 2:
                $route = '/topic/demo2';
                $data = [
                    'name' => 'demo2' . mt_rand(0,100)
                ];
                break;
            case 3:
                $route = '/topic/demo3';
                $data = [
                    'name' => 'demo3' . mt_rand(0,100)
                ];
                break;
            case 4:
                $route = '/topic/demo4';
                $data = [
                    'name' => 'demo4' . mt_rand(0,100)
                ];
                break;
            case 5:
                $route = '/topic/demo5';
                $data = [
                    'name' => 'demo5' . mt_rand(0,100)
                ];
                break;
            default :
                $route = '/topic/default';
                $data = [
                    'name' => 'default' . mt_rand(0,100)
                ];
                break;
        }
        $result = $connect->send($route,json_encode($data), array('persistent' => 'true'));//第三个参数重启mq不丢失
        echo $result . PHP_EOL;
    }
}
