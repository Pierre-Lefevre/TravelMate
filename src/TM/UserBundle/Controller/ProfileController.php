<?php

namespace TM\UserBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use TM\UserBundle\Entity\User;
use TM\UserBundle\Form\ProfilePictureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class ProfileController
 * @package TM\UserBundle\Controller
 */
class ProfileController extends BaseController
{
    /**
     * @param User|null $user
     * @return Response
     */
    public function showAction(User $user = null)
    {
        if ($user == null) {
            $user = $this->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        }

        return $this->render('@FOSUser/Profile/show.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param User|null $user
     * @return null|RedirectResponse|Response
     */
    public function editAction(Request $request, User $user = null)
    {
        if ($user == null) {
            $user = $this->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        }

        $this->denyAccessUnlessGranted('edit', $user);

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $formProfilePicture = $this->createForm(ProfilePictureType::class);
        $formProfilePicture->setData($user);
        $formProfilePicture->handleRequest($request);
        if ($formProfilePicture->isSubmitted() && $formProfilePicture->isValid()) {
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            if (null === $response = $event->getResponse()) {
                $url      = $this->generateUrl('tm_user_profile_show', array('id' => $user->getId()));
                $response = new RedirectResponse($url);
            }
            return $response;
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url      = $this->generateUrl('tm_user_profile_show', array('id' => $user->getId()));
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED,
                new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form'               => $form->createView(),
            'formProfilePicture' => $formProfilePicture->createView(),
            'user'               => $user
        ));
    }
}
