<?php

namespace App\Command;

use Message\Project\CreateProject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SendMessageCommand extends Command
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct('app:send-message');
        $this->bus = $bus;
    }

    protected function configure()
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Product name')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $message = new CreateProject();
        $message->setName($input->getArgument('name'));
        $message->setId(rand(1, 1000));

        $this->bus->dispatch($message);

        $output->writeln('<info>Message sent successfully</info>');

        return self::SUCCESS;
    }
}