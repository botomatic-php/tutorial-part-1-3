<?php 

namespace App\Bot\Facebook\States\Workflow\Todo\Create;

use \Botomatic\Engine\Facebook\Entities\Response;
use \Botomatic\Engine\Facebook\Abstracts\States\Workflow\Traits;

/**
 * Class Create
 * @package  App\Bot\Facebook\States\Workflow\Todo\Create
 */
class Create extends \Botomatic\Engine\Facebook\Abstracts\States\Workflow
{
    /**
     * Implements Steps
     */
    use \Botomatic\Engine\Facebook\Abstracts\States\Workflow\Traits\Steps;

    /**
     * Save step
     *
     * @var array
     */
    protected $serializes = ['step'];

    /**
     * @var  \App\Bot\Facebook\States\Workflow\Todo\Create\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Workflow\Todo\Create\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->isFirstStep())
        {
            // moves the State to second step
            $this->nextStep();

            return $this->response->responseDefault();
        }
        elseif ($this->isSecondStep())
        {
            $todo = new \App\Bot\Facebook\BusinessLogic\Jarvis\Todo();
            $todo->save($this->message->getTodo());

            return $this->response->finish($this->message->getTodo());
        }
        else
        {
            // Failsafe logic
        }
    }
}