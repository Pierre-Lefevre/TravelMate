<?php

namespace TM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function contactAction(Request $request)
    {
        $session = $request->getSession();

        $session->getFlashBag()->add('info',
            'La page de contact n’est pas encore disponible, merci de revenir plus tard.');

        return $this->redirectToRoute('tm_core_index');
    }
}
