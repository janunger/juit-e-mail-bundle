<?php

namespace JUIT\EMailBundle\Service;

use Swift_Message;

class EMailFactory
{
    /**
     * @var string|null
     */
    private $defaultSenderAddress;

    /**
     * @var string|null
     */
    private $defaultSenderName;

    /**
     * @param string|null $defaultSenderAddress
     * @param string|null $defaultSenderName
     */
    public function __construct($defaultSenderAddress = null, $defaultSenderName = null)
    {
        $this->defaultSenderAddress = $defaultSenderAddress;
        $this->defaultSenderName = $defaultSenderName;
    }

    public function createEMail($senderAddress = null, $senderName = null)
    {
        $mail = Swift_Message::newInstance();

        if (null !== $senderAddress) {
            $mail->setFrom($senderAddress, $senderName);
        } else if (null !== $this->defaultSenderAddress) {
            $mail->setFrom($this->defaultSenderAddress, $this->defaultSenderName);
        }

        return $mail;
    }
} 
