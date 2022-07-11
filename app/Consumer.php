<?php

use NorteDev\Produtor;

require __DIR__ . '/vendor/autoload.php';

$conf = new RdKafka\Conf();
$conf->set('group.id', 'myConsumerGroup');
$rk = new RdKafka\Consumer($conf);
$rk->addBrokers(BOOTSTRAP_SERVER);
$topicConf = new RdKafka\TopicConf();
$topicConf->set('auto.commit.interval.ms', 100);
$topicConf->set('offset.store.method', 'broker');
$topicConf->set('auto.offset.reset', 'earliest');
$topic = $rk->newTopic(TOPICS[0], $topicConf);
$topic->consumeStart(PARTITION, RD_KAFKA_OFFSET_STORED);
while (true) {
    $message = $topic->consume(PARTITION, 120 * 10000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            if ($message->payload) {
                $data = json_decode($message->payload, true);
//                $date = new DateTime('@' . $data['timestamp']);
//                $now = new DateTime('now');
//                $diff = $now->diff($date);
//                var_dump($diff);
//                exit;

                $findIp = new \NorteDev\FindIp($data['ip']);
                $ipData = $findIp->response();
                $output = [
                    'clientID' => $data['clientID'],
                    'ip' => $ipData['ip'],
                    'latitude' => $ipData['latitude'],
                    'longitude' => $ipData['longitude'],
                    'country' => [
                        'code' => $ipData['continent_code'],
                        'name' => $ipData['continent_name'],
                    ],
                    'region' => [
                        'code' => $ipData['region_code'],
                        'name' => $ipData['region_name'],
                    ],
                    'city' => $ipData['city'],
                    'timestamp' => time(),
                ];
                $mensagem = new Produtor();
                $mensagem->producer(null, TOPICS[1], $output);
            }
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "No more messages; will wait for more\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timed out\n";
            break;
        default:
            throw new \Exception($message->errstr(), $message->err);
            break;
    }
}