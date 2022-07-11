<?php

namespace NorteDev;

use Kafka\Producer;
use Kafka\ProducerConfig;

class Messages
{
    private ProducerConfig $config;

    public function __construct(bool $isProducer = true)
    {
        if ($isProducer) {
            $this->config = ProducerConfig::getInstance();
            $this->config->setMetadataRefreshIntervalMs(REFRESH_INTERVAL);
            $this->config->setMetadataBrokerList(BOOTSTRAP_SERVER);
            $this->config->setBrokerVersion(BROKER_VERSION);
            $this->config->setRequiredAck(REQUIRED_ACK_QUANTITY);
            $this->config->setIsAsyn(false);
            $this->config->setProduceInterval(PRODUCE_INTERVAL);
        }
    }

    public function producer(array $message = [], string $key = null)
    {
        if (is_null($key)) {
            $key = uniqid(time(), true);
        }
        $producer = new Producer(
            function () use ($key, $message) {
                return [
                    [
                        'topic' => TOPICS[0],
                        'value' => json_encode($message),
                        'key' => $key,
                    ],
                ];
            }
        );
        $producer->success(function ($result) {
            $this->response($result);
        });
        $producer->error(function ($errorCode) {
            $this->response(['error' => $errorCode]);
        });
        $producer->send(true);
    }

    public function response($data)
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}