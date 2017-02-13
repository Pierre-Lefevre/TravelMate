<?php

namespace TM\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TM\PlatformBundle\Entity\Travel;
use TM\PlatformBundle\Form\TravelEditType;
use TM\PlatformBundle\Form\TravelType;

class TravelController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }
        // Ici je fixe le nombre d'annonces par page à 3
        // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
        $nbPerPage = 10;
        // On récupère notre objet Paginator
        $travels = $this->getDoctrine()
            ->getManager()
            ->getRepository('TMPlatformBundle:Travel')
            ->getTravels($page, $nbPerPage)
        ;
        // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($travels) / $nbPerPage);
        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }
        // On donne toutes les informations nécessaires à la vue
        return $this->render('TMPlatformBundle:Travel:index.html.twig', array(
            'travels' => $travels,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }

    public function viewAction(Travel $travel)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('TMPlatformBundle:Travel:view.html.twig', array(
            'travel'           => $travel
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

            $request->getSession()->getFlashBag()->add('info', 'Voyage bien enregistrée.');

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
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(TravelEditType::class, $travel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Voyage bien modifiée.');
            return $this->redirectToRoute('tm_platform_view', array('id' =>
                                                                       $travel->getId()));
        }

        return $this->render('TMPlatformBundle:Travel:edit.html.twig', array(
            'travel' => $travel,
            'form'   => $form->createView(),
        ));
    }

    public function deleteAction(Travel $travel, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($travel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "Le voyage a bien été supprimée.");

            return $this->redirectToRoute('tm_platform_homepage');
        }

        return $this->render('TMPlatformBundle:Travel:delete.html.twig', array(
            'travel' => $travel,
            'form'   => $form->createView(),
        ));
    }

    public function lastAction($limit)
    {
        $em = $this->getDoctrine()->getManager();
        $travels = $em->getRepository('TMPlatformBundle:Travel')->findBy(
            array(),
            array('creationDate' => 'desc'),
            $limit,
            0
        );
        return $this->render('TMPlatformBundle:Travel:last.html.twig', array(
            'travels' => $travels
        ));
    }
}