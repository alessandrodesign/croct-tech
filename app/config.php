<?php
const SERVER = "kafka";
const SERVER_PORT = 9092;
const BOOTSTRAP_SERVER = SERVER . ":" . SERVER_PORT;
const TOPICS = ['default','location'];
const GROUP_ID = 'group';
const BROKER_VERSION = '1.0.0';
const REFRESH_INTERVAL = 10000;
const PRODUCE_INTERVAL = 10000;
const REQUIRED_ACK_QUANTITY = 1;
const PARTITION=0;