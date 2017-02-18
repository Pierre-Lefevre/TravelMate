<?php

namespace TM\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Intl\Intl;
use TM\PlatformBundle\Entity\Travel;
use TM\PlatformBundle\Form\TravelEditType;
use TM\PlatformBundle\Form\TravelSearchType;
use TM\PlatformBundle\Form\TravelType;

class TravelController extends Controller
{
    public function indexAction(Request $request, $page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }

        $form = $this->createForm(TravelSearchType::class);

        if ($request->getMethod() == 'POST' && $form->handleRequest($request)->isValid()) {
            $request->getSession()->set("form_search_data", $request->request->get($form->getName()));
        }
        $nbResults = 0;
        $nbPerPage = 10;
        $parameters = $request->getSession()->has("form_search_data") ? $request->getSession()->get("form_search_data") : array();
        $travels    = $this->getDoctrine()->getManager()->getRepository('TMPlatformBundle:Travel')->getTravelsByParameters($parameters,
                $page, $nbPerPage, $nbResults);
        $nbPages = ceil(count($travels) / $nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        return $this->render('TMPlatformBundle:Travel:index.html.twig', array(
            'form' => $form->createView(),
            'nbResults' => $nbResults,
            'travels' => $travels,
            'nbPages' => $nbPages,
            'page'    => $page,
        ));
    }

    public function viewAction(Request $request, Travel $travel)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($travel);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "Le voyage a bien été supprimée.");
            return $this->redirectToRoute('tm_platform_home');
        }

        return $this->render('TMPlatformBundle:Travel:view.html.twig', array(
            'travel' => $travel,
            'form'   => $form->createView()
        ));
    }

    public function addAction(Request $request)
    {
        $travel = new Travel();
        $form   = $this->createForm(TravelType::class, $travel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info',
                'Voyage bien enregistrée.');

            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('TMPlatformBundle:Travel:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Travel $travel, Request $request)
    {
        $em   = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(TravelEditType::class, $travel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice',
                'Voyage bien modifiée.');
            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        return $this->render('TMPlatformBundle:Travel:edit.html.twig', array(
            'travel' => $travel,
            'form'   => $form->createView(),
        ));
    }

    public function lastAction($limit)
    {
        $em      = $this->getDoctrine()->getManager();
        $travels = $em->getRepository('TMPlatformBundle:Travel')->findBy(array(),
            array('creationDate' => 'desc'), $limit, 0);
        return $this->render('TMPlatformBundle:Travel:list.html.twig', array(
            'travels' => $travels
        ));
    }
}
