<?php

namespace App\Handler;

use Message\Project\CreateProject;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateProjectHandler implements MessageHandlerInterface
{
    public function __invoke(CreateProject $message)
    {
        echo 'CreateProject message: ' . $message->getId() . ' ' . $message->getName() . PHP_EOL;
    }
}