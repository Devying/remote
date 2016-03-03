<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


echo "这是我在2016年3月3日14:41:37加的一行";
$data = implode(' ', array_slice($argv, 1));
if(empty($data)) $data = "Hello World!";
echo "1111111111111";
$msg = new AMQPMessage($data,
                        array('delivery_mode' => 2) # make message persistent
                      );

if ($params['AdSearch']['product'] != '') {
        $query->andWhere(['like', 'nao.product', $params['AdSearch']['product']]);
    }
    if ($params['AdSearch']['partners'] != '') {
        $query->andWhere(['like', 'nao.partners', $params['AdSearch']['partners']]);
    }

$channel->basic_publish($msg, '', 'task_queue');

echo " [x] Sent ", $data, "\n";
echo "你好";
$channel->close();
$connection->close();

?>