<?php

namespace Juit\EMailBundle\Command;

use Swift_FileSpool;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class MailSendingCommand extends ContainerAwareCommand
{
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $result = parent::run($input, $output);

        $this->sendQueuedMails();

        return $result;
    }

    protected function sendQueuedMails()
    {
        /** @var $transport \Swift_Transport */
        $transport = $this->getContainer()->get('swiftmailer.transport.real');

        /** @var $spool Swift_FileSpool */
        $spool = $this->getContainer()->get('mailer')->getTransport()->getSpool();

        $spool->flushQueue($transport);
    }
}
