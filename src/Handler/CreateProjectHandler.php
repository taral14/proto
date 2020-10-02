<?php

namespace App\Handler;

use Message\Project\CreateProject;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateProjectHandler implements MessageHandlerInterface
{
    public function __invoke(CreateProject $message)
    {
        echo 'Exec command CreateProject';
        echo PHP_EOL;
        echo $message->getId() . ' ' . $message->getName();
        echo PHP_EOL;
    }
}