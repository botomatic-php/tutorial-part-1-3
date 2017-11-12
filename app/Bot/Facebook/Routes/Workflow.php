<?php

use App\Bot\Facebook\States\Listener\Listener;
use Botomatic\Engine\Facebook\Entities\Response;

return [
    /*--------------------------------------------------------------------------------------------------------------
     *
     * Listener
     *
     -------------------------------------------------------------------------------------------------------------*/
    Listener::class => [
        'switch_to_todo_flow' => \App\Bot\Facebook\States\Workflow\Todo\Create\Create::class,
    ],

    /*--------------------------------------------------------------------------------------------------------------
     *
     * Todo Workflow
     *
     -------------------------------------------------------------------------------------------------------------*/
    \App\Bot\Facebook\States\Workflow\Todo\Create\Create::class => [
        Response::STATUS_FINISH => Listener::class,
    ],
];