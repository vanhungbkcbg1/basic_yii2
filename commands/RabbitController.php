<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RabbitController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'admin', 'admin');
        $channel = $connection->channel();

        $channel->queue_declare('demo', false, true, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };

        $channel->basic_consume('demo', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    public function actionQueue($message = 'hello world')
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'admin', 'admin');
        $channel = $connection->channel();

        $channel->queue_declare('demo', false, true, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
            sleep(substr_count($msg->body, '.'));
            echo " [x] Done\n";

        };

        $channel->basic_consume('demo', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    public function actionPush($message){
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'admin', 'admin');
        $channel = $connection->channel();

        $channel->queue_declare('demo', false, true, false, false);

        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, '', 'demo');


        $channel->close();
        $connection->close();
    }

    public function actionPublish($message="Hello Publish"){
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'admin', 'admin');
        $channel = $connection->channel();

//        $channel->queue_declare('demo', false, true, false, false);

        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, 'demo_fanout');


        $channel->close();
        $connection->close();
        echo "Done";
    }

    public function actionSubscribe(){
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'admin', 'admin');
        $channel = $connection->channel();


        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";

        };

        // I am
        $channel->basic_consume('fanout_1', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

}
