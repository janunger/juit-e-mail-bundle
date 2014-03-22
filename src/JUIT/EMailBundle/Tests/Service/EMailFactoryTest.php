<?php

namespace JUIT\EMailBundle\Tests\Service;

use JUIT\EMailBundle\Service\EMailFactory;

class EMailFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_mail_instances()
    {
        $SUT = new EMailFactory();

        $this->assertInstanceOf('Swift_Message', $SUT->createEMail());
    }

    /**
     * @test
     */
    public function it_should_set_a_default_sender_email_address()
    {
        $SUT = new EMailFactory('john.doe@example.com');
        $mail = $SUT->createEMail();

        $this->assertEquals(['john.doe@example.com' => null], $mail->getFrom());
    }

    /**
     * @test
     */
    public function it_should_set_a_default_sender_email_address_and_name()
    {
        $SUT = new EMailFactory('john.doe@example.com', 'John Doe');
        $mail = $SUT->createEMail();

        $this->assertEquals(['john.doe@example.com' => 'John Doe'], $mail->getFrom());
    }

    /**
     * @test
     */
    public function it_should_set_a_custom_sender_email_address()
    {
        $SUT = new EMailFactory('john.doe@example.com', 'John Doe');
        $mail = $SUT->createEMail('jane.doe@example.com');

        $this->assertEquals(['jane.doe@example.com' => null], $mail->getFrom());
    }

    /**
     * @test
     */
    public function it_should_set_a_custom_sender_email_address_and_name()
    {
        $SUT = new EMailFactory('john.doe@example.com', 'John Doe');
        $mail = $SUT->createEMail('jane.doe@example.com', 'Jane Doe');

        $this->assertEquals(['jane.doe@example.com' => 'Jane Doe'], $mail->getFrom());
    }
}
