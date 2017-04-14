<?php

namespace TM\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TM\ChatBundle\Entity\Message;
use TM\ChatBundle\Form\MessageType;
use TM\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class ChatController
 * @package TM\ChatBundle\Controller
 */
class ChatController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param User|null $userReceiver
     * @return Response
     */
    public function userAction(Request $request, User $userReceiver = null)
    {
        $message = new Message();
        $form    = $this->get('form.factory')->create(MessageType::class, $message);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message->setSender($this->getUser());
            $message->setReceiver($userReceiver);
            $em->persist($message);
            $em->flush();
            if ($request->isXmlHttpRequest()) {
                return new Response(json_encode(array('status' => 'success')));
            }
        }

        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TMChatBundle:Message');

        $receivers = $repository->getDistinctReceiver($this->getUser()->getId());
        if ($userReceiver !== null && !in_array($userReceiver, $receivers)) {
            $receivers[] = $userReceiver;
        }
        if ($userReceiver === null && count($receivers) > 0) {
            $userReceiver = $receivers[0];
        }

        $messages = array();
        if ($userReceiver !== null) {
            $messages = $repository->findMessagesOfConversation($this->getUser()->getId(), $userReceiver->getId());
        }

        return $this->render('TMChatBundle:Chat:chat.html.twig', array(
            "form"         => $form->createView(),
            "messages"     => $messages,
            "userReceiver" => $userReceiver,
            "receivers"    => $receivers
        ));
    }

    /**
     * @param Request $request
     * @param User $userReceiver
     * @return Response
     */
    public function newMessageAction(Request $request, User $userReceiver)
    {
        $dateMin = $request->request->get("dateMin");
        $dateMax = $request->request->get("dateMax");

        $em          = $this->getDoctrine()->getManager();
        $repository  = $em->getRepository('TMChatBundle:Message');
        $newMessages = $repository->findNewMessage($this->getUser()->getId(), $userReceiver->getId(), $dateMin,
            $dateMax);

        $messages = array();
        foreach ($newMessages as $newMessage) {
            $messages[] = array(
                "content"        => $newMessage->getContent(),
                "profilePicture" => '/TravelMate/web/uploads/user/profilepics/' . $newMessage->getSender()->getProfilePicturePath(),
                "me"             => $newMessage->getSender()->getId() === $this->getUser()->getId() ? true : false
            );
        }

        return new Response(json_encode(array('status' => 'success', 'messages' => $messages)));
    }
}
