<?php

namespace Juit\EMailBundle\Command;

use RuntimeException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendTestMailCommand extends MailSendingCommand
{
    protected function configure()
    {
        $this->setName('juit:email:send-test-mail');
        $this->setDescription("Send a test email to a given recipient, using the app's mail configuration");
        $this->addArgument('to', InputArgument::REQUIRED, "The email address to send the mail to");
        $this->addOption('from', null, InputOption::VALUE_REQUIRED, "The sender's email address");
        $this->addOption('from-name', null, InputOption::VALUE_REQUIRED, "The sender's name");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $mail \Swift_Message */
        $mail = $this->getContainer()->get('juit_e_mail.e_mail_factory')->createEMail();

        if ($input->getOption('from')) {
            $mail->setFrom($input->getOption('from'), $input->getOption('from-name'));
        }

        if (!$mail->getFrom()) {
            throw new RuntimeException("Please provide a parameter 'default_e_mail_sender_address' in your configuration or use the '--from' option.");
        }

        $mail->setTo($input->getArgument('to'));
        $mail->setSubject('Test Mail');
        $mail->setBody('This is a test mail.', 'text/plain');

        $this->getContainer()->get('mailer')->send($mail);
    }
}
