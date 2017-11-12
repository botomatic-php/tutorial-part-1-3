<?php

namespace App\Bot\Facebook\States\Listener\Handlers;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package App\Bot\Facebook\States\Listener\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @param string $name
     *
     * @return \Botomatic\Engine\Facebook\Entities\Response
     */
    public function responseDefault(string $name) : Response
    {
        return $this->response
            ->addMessage('Hello ' . $name . '! How can I help?')
            ->sendResponse()
            ->setStatusActive();
    }

    /**
     * @return \Botomatic\Engine\Facebook\Entities\Response
     */
    public function options() : Response
    {
        return $this->response->addMessage('Can\'t understand that.... say hi')
            ->sendResponse()
            ->setStatusActive();
    }

    /**
     * @return Response
     */
    public function switchToTodoFlow() : Response
    {
        return $this->response->setStatus('switch_to_todo_flow');
    }

}
