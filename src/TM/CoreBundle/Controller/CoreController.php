<?php

namespace TM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TM\CoreBundle\Form\ConnectedContactType;
use TM\CoreBundle\Form\NotConnectedContactType;
use TM\PlatformBundle\Form\TravelSearchType;

/**
 * Class CoreController
 * @package TM\CoreBundle\Controller
 */
class CoreController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(TravelSearchType::class);

        if ($request->getMethod() == 'POST' && $form->handleRequest($request)->isValid()) {
            $request->getSession()->set("form_search_data", $request->request->get($form->getName()));
            return $this->redirectToRoute('tm_platform_search');
        }

        return $this->render('TMCoreBundle:Core:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $type = NotConnectedContactType::class;
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $type = ConnectedContactType::class;
        }

        $form = $this->createForm($type, null, array(
            'action' => $this->generateUrl('tm_core_contact'),
            'method' => 'POST'
        ));

        if ($request->getMethod() == 'POST' && $form->handleRequest($request)->isValid()) {
            $data = $form->getData();

            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                $data["name"] = $this->getUser()->getFirstName() . " " . $this->getUser()->getLastname();
                $data["email"] = $this->getUser()->getEmail();
            }

            if ($this->get('tm_core_mailer')->sendContactMessage($data)) {
                $request->getSession()->getFlashBag()->add('info', 'Message envoyé.');
                return $this->redirectToRoute('tm_core_index');
            }
        }

        return $this->render('TMCoreBundle:Core:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
