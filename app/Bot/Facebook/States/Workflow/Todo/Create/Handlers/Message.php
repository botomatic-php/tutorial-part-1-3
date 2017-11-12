<?php 

namespace App\Bot\Facebook\States\Workflow\Todo\Create\Handlers;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Workflow\Todo\Create\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return string
     */
    public function getTodo() : string
    {
        return $this->message()->getMessage();
    }
}
