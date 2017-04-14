<?php

namespace TM\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TM\PlatformBundle\Entity\Comment;
use TM\PlatformBundle\Entity\Travel;
use TM\PlatformBundle\Form\CommentEditType;
use TM\PlatformBundle\Form\CommentType;
use TM\PlatformBundle\Form\TravelEditType;
use TM\PlatformBundle\Form\TravelSearchType;
use TM\PlatformBundle\Form\TravelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class TravelController
 * @package TM\PlatformBundle\Controller
 */
class TravelController extends Controller
{
    /**
     * @param Request $request
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request, $page)
    {
        $this->get('app.breadcrumb')->listTravel();

        if ($page < 1) {
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }

        $form = $this->createForm(TravelSearchType::class);

        if ($request->getMethod() == 'POST' && $form->handleRequest($request)->isValid()) {
            $request->getSession()->set("form_search_data", $request->request->get($form->getName()));
        }
        $nbResults  = 0;
        $nbPerPage  = 10;
        $parameters = $request->getSession()->has("form_search_data") ? $request->getSession()->get("form_search_data") : array();
        $travels    = $this->getDoctrine()->getManager()->getRepository('TMPlatformBundle:Travel')->getTravelsByParameters($parameters,
            $page, $nbPerPage, $nbResults);

        $nbPages = ceil(count($travels) / $nbPerPage);

        return $this->render('TMPlatformBundle:Travel:search.html.twig', array(
            'form'      => $form->createView(),
            'nbResults' => $nbResults,
            'travels'   => $travels,
            'nbPages'   => $nbPages,
            'page'      => $page,
        ));
    }

    /**
     * @param Request $request
     * @param Travel $travel
     * @return array|\Symfony\Component\Form\Form|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, Travel $travel)
    {
        $this->get('app.breadcrumb')->viewTravel($travel->getId());

        if (($formDeleteTravel = $this->getAndCheckRemoveTravelForm($request, $travel)) instanceof RedirectResponse) {
            return $formDeleteTravel;
        }
        if (($formAddComment = $this->getAndCheckAddCommentForm($request, $travel)) instanceof RedirectResponse) {
            return $formAddComment;
        }
        if (($formsEditComment = $this->getAndCheckEditCommentForm($request, $travel)) instanceof RedirectResponse) {
            return $formsEditComment;
        }
        $formDeleteComment = $this->get('form.factory')->create();

        return $this->render('TMPlatformBundle:Travel:view.html.twig', array(
            'travel'            => $travel,
            'formDeleteTravel'  => $formDeleteTravel->createView(),
            'formAddComment'    => $formAddComment->createView(),
            'formsEditComment'  => $formsEditComment,
            'formDeleteComment' => $formDeleteComment->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param Travel $travel
     * @return RedirectResponse
     */
    public function getAndCheckRemoveTravelForm(Request $request, Travel $travel)
    {
        $formDeleteTravel = $this->get('form.factory')->create();

        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST') && $formDeleteTravel->handleRequest($request)->isValid()) {
            $em->remove($travel);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "Le voyage a bien été supprimée.");
            return $this->redirectToRoute('tm_core_index');
        }

        return $formDeleteTravel;
    }

    /**
     * @param Request $request
     * @param Travel $travel
     * @return \Symfony\Component\Form\Form|RedirectResponse
     */
    public function getAndCheckAddCommentForm(Request $request, Travel $travel)
    {
        $comment        = new Comment();
        $formAddComment = $this->createForm(CommentType::class, $comment);

        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST') && $formAddComment->handleRequest($request)->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $comment->setUser($user);

            $travel->addComment($comment);
            $em->persist($travel);
            $em->flush();
            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        return $formAddComment;
    }

    /**
     * @param Request $request
     * @param Travel $travel
     * @return array|RedirectResponse
     */
    public function getAndCheckEditCommentForm(Request $request, Travel $travel)
    {
        $formsEditComment = array();
        foreach ($travel->getComments() as $comment) {
            $formsEditComment[$comment->getId()] = $this->get('form.factory')->createNamedBuilder('comment_edit_' . $comment->getId(),
                CommentEditType::class, $comment)->getForm();
        }

        $em = $this->getDoctrine()->getManager();
        foreach ($formsEditComment as $key => $formEditComment) {
            if ($request->isMethod('POST') && $formEditComment->handleRequest($request)->isValid()) {
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', "Le commentaire a bien été modifié.");
                return $this->redirectToRoute('tm_platform_view', array(
                    'id' => $travel->getId()
                ));
            }
        }

        foreach ($formsEditComment as $key => $formEditComment) {
            $formsEditComment[$key] = $formEditComment->createView();
        }

        return $formsEditComment;
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $this->get('app.breadcrumb')->addTravel();

        $travel = new Travel();
        $form   = $this->createForm(TravelType::class, $travel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $travel->setUser($user);

            $em->persist($travel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Voyage bien enregistrée.');

            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        return $this->render('TMPlatformBundle:Travel:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Travel $travel
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Travel $travel, Request $request)
    {
        $this->get('app.breadcrumb')->editTravel($travel->getId());

        $em   = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(TravelEditType::class, $travel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'Voyage bien modifiée.');
            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        return $this->render('TMPlatformBundle:Travel:edit.html.twig', array(
            'travel' => $travel,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @param $limit
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lastAction($limit)
    {
        $em      = $this->getDoctrine()->getManager();
        $travels = $em->getRepository('TMPlatformBundle:Travel')->findBy(array(), array('creationDate' => 'desc'),
            $limit, 0);
        return $this->render('TMPlatformBundle:Travel:list.html.twig', array(
            'travels' => $travels
        ));
    }
}
