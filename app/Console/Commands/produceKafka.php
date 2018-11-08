<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class produceKafka extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'produce:kafka';

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
        $config = \Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setBrokerVersion('0.10.2.1');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer(function () {
            return [
                [
                    'topic' =>'test',
                    'value' => '3333'
                ],
            ];
        });
        $producer->success(function ($result) {
            echo  "success";
        });
        $producer->error(function ($errorCode) {
            echo $errorCode;
        });
        $producer->send(true);
    }
}
