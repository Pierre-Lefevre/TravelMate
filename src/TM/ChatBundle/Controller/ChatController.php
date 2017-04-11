<?php

namespace TM\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TM\ChatBundle\Entity\Message;
use TM\ChatBundle\Form\MessageType;
use TM\UserBundle\Entity\User;

class ChatController extends Controller
{
    public function listAction(Request $request)
    {
        return $this->render('TMChatBundle:Chat:chat_list.html.twig', array());
    }

    public function userAction(Request $request, User $userReceiver)
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
        $messages   = $repository->findMessagesOfConversation($this->getUser()->getId(), $userReceiver->getId());

        return $this->render('TMChatBundle:Chat:chat_user.html.twig', array(
            "form"         => $form->createView(),
            "messages"     => $messages,
            "userReceiver" => $userReceiver
        ));
    }

    public function newMessageAction(Request $request, User $userReceiver)
    {
        $dateMin = $request->request->get("dateMin");
        $dateMax = $request->request->get("dateMax");

        $em          = $this->getDoctrine()->getManager();
        $repository  = $em->getRepository('TMChatBundle:Message');
        $newMessages = $repository->findNewMessage($this->getUser()->getId(), $userReceiver->getId(), $dateMin, $dateMax);

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
