<?php

namespace TM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TM\PlatformBundle\Form\TravelSearchType;

class CoreController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(TravelSearchType::class);

        if ($request->getMethod() == 'POST' && $form->handleRequest($request)->isValid()) {
            $request->getSession()->set("form_search_data", $request->request->get($form->getName()));
            return $this->redirectToRoute('tm_platform_home');
        }

        /*
        $flashBag = $request->getSession()->getFlashBag();
        $flashBag->add('success', 'Voyage bien enregistrée.');
        $flashBag->add('warning', 'Voyage bien enregistrée.');
        $flashBag->add('info', 'Voyage bien enregistrée.');
        $flashBag->add('danger', 'Voyage bien enregistrée.');
        */

        return $this->render('TMCoreBundle:Core:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function contactAction(Request $request)
    {
        // On récupère la session depuis la requête, en argument du contrôleur
        $session = $request->getSession();
        // Et on définit notre message
        $session->getFlashBag()->add('info',
            'La page de contact n’est pas encore disponible, merci de revenir plus tard.');
        // Enfin, on redirige simplement vers la page d'accueil
        return $this->redirectToRoute('tm_core_home');
        // La méthode longue new RedirectResponse($this->get('router')->generate('oc_core_home')); est parfaitement valable
    }
}
