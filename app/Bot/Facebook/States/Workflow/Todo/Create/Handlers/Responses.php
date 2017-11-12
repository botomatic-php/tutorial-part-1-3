<?php 

namespace App\Bot\Facebook\States\Workflow\Todo\Create\Handlers;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Workflow\Todo\Create\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    public function responseDefault() : Response
    {
        return $this->response->addMessage('Ok, what todo?')
            ->setStatusActive()
            ->sendResponse();
    }

    /**
     * @param string $todo
     *
     * @return Response
     */
    public function finish(string $todo) : Response
    {
        return $this->response
            ->addMessage('Alright, I will save "' . $todo . '" to your todo list.')
            ->sendResponse()
            ->setStatusFinish();
    }
}
