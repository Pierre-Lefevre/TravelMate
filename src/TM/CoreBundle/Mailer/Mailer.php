<?php

namespace TM\CoreBundle\Mailer;

use Symfony\Component\Templating\EngineInterface;

/**
 * Class Mailer
 * @package TM\CoreBundle\Mailer
 */
class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param EngineInterface $templating
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $data
     * @return int
     */
    public function sendContactMessage($data)
    {
        $from = array($data["email"] => 'Travel Mate');
        $to = array('lefevre.pierre.m.d@gmail.com' => 'Pierre Lefèvre');
        $subject = $data["subject"];
        $body = $this->templating->render('Emails/contact.html.twig', array(
            'sujet'   => $data["subject"],
            'name'    => $data["name"],
            'email'   => $data["email"],
            'message' => $data["message"],
        ));

        return $this->sendMessage($from, $to, $subject, $body);
    }

    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $body
     * @return int
     */
    protected function sendMessage($from, $to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        return $this->mailer->send($mail);
    }
}