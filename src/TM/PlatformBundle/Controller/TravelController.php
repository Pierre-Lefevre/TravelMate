<?php

namespace TM\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
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
     * @param null $code
     * @return Response
     */
    public function searchAction(Request $request, $page, $code = null)
    {
        $this->get('app.breadcrumb')->listTravel();

        if ($page < 1) {
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }

        $form = $this->createForm(TravelSearchType::class, null, array(
            "code" => $code
        ));

        $parameters = array();
        if ($request->getMethod() == 'GET' && $form->handleRequest($request)->isValid()) {
            $parameters = $form->getData();
        }

        if ($code !== null) {
            $parameters['countries'] = $code;
        }

        $nbResults = 0;
        $nbPerPage = 10;
        $travels   = $this->getDoctrine()->getManager()->getRepository('TMPlatformBundle:Travel')->getTravelsByParameters($parameters, $page, $nbPerPage, $nbResults);
        $nbPages   = ceil(count($travels) / $nbPerPage);

        return $this->render('TMPlatformBundle:Travel:search_travel.html.twig', array(
            'form'      => $form->createView(),
            'nbResults' => $nbResults,
            'travels'   => $travels,
            'nbPages'   => $nbPages,
            'page'      => $page
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
        if (($formsDeleteComment = $this->getAndCheckDeleteCommentForm($request, $travel)) instanceof RedirectResponse) {
            return $formsDeleteComment;
        }

        $formDeleteComment = $this->get('form.factory')->create();

        return $this->render('TMPlatformBundle:Travel:view_travel.html.twig', array(
            'travel'            => $travel,
            'formDeleteTravel'  => $formDeleteTravel->createView(),
            'formAddComment'    => $formAddComment->createView(),
            'formsEditComment'  => $formsEditComment,
            'formsDeleteComment' => $formsDeleteComment,
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

            $this->denyAccessUnlessGranted('delete', $travel);

            $em->remove($travel);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "Voyage supprimé.");
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
            $request->getSession()->getFlashBag()->add('info', "Commentaire ajouté.");
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
            $comment = $em->getRepository('TMPlatformBundle:Comment')->find($key);

            if ($request->isMethod('POST') && $formEditComment->handleRequest($request)->isValid()) {
                $this->denyAccessUnlessGranted('edit', $comment);

                $em->flush();
                $request->getSession()->getFlashBag()->add('info', "Commentaire modifié.");
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
     * @param Request $request
     * @param Travel $travel
     * @return array|RedirectResponse
     */
    public function getAndCheckDeleteCommentForm(Request $request, Travel $travel)
    {
        $formsDeleteComment = array();
        foreach ($travel->getComments() as $comment) {
            $formsDeleteComment[$comment->getId()] = $this->get('form.factory')->createNamed('comment_delete_' .
                    $comment->getId());
        }

        $em = $this->getDoctrine()->getManager();
        foreach ($formsDeleteComment as $key => $formDeleteComment) {
            $comment = $em->getRepository('TMPlatformBundle:Comment')->find($key);

            if ($request->isMethod('POST') && $formDeleteComment->handleRequest($request)->isValid()) {
                $em->remove($comment);
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', "Commentaire supprimé.");
                return $this->redirectToRoute('tm_platform_view', array(
                    'id' => $travel->getId()
                ));
            }
        }

        foreach ($formsDeleteComment as $key => $formDeleteComment) {
            $formsDeleteComment[$key] = $formDeleteComment->createView();
        }

        return $formsDeleteComment;
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

            $request->getSession()->getFlashBag()->add('info', 'Voyage ajouté.');

            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        return $this->render('TMPlatformBundle:Travel:add_travel.html.twig', array(
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
        $this->denyAccessUnlessGranted('edit', $travel);

        $this->get('app.breadcrumb')->editTravel($travel->getId());

        $em   = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(TravelEditType::class, $travel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'Voyage modifié.');
            return $this->redirectToRoute('tm_platform_view', array(
                'id' => $travel->getId()
            ));
        }

        return $this->render('TMPlatformBundle:Travel:edit_travel.html.twig', array(
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

        return $this->render('TMPlatformBundle:Travel:list_travel.html.twig', array(
            'travels' => $travels
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function mapAction(Request $request)
    {
        return $this->render('TMPlatformBundle:Travel:map.html.twig');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxCountryCodesAction(Request $request)
    {
        $results = $this->getDoctrine()->getRepository('TMPlatformBundle:Travel')->getAllTravelCountryCode();

        $countryCodes = array();
        foreach ($results as $result) {
            $countryCodes = array_merge($countryCodes, $result["countries"]);
        }

        $countryCodes = array_diff(array_unique($countryCodes), array("EZ", "UN"));

        $countCountryCodes = array();
        foreach ($countryCodes as $countryCode) {
            $country                                = $this->getDoctrine()->getRepository('TMPlatformBundle:Country')->getAllTravelCountryCode($countryCode);
            $countCountryCodes[$countryCode]["lat"] = $country[0]->getLatitude();
            $countCountryCodes[$countryCode]["lng"] = $country[0]->getLongitude();
        }

        return new JsonResponse(array(
            'code' => $countCountryCodes
        ));
    }

    /**
     * @param Request $request
     * @param $code
     * @return Response
     */
    public function ajaxLastTravelAction(Request $request, $code)
    {
        $travelRepository = $this->getDoctrine()->getRepository('TMPlatformBundle:Travel');
        $travels          = $travelRepository->getLastTravelByCode($code, 2);
        $nbTravels        = $travelRepository->getNumberTravelByCode($code);

        return $this->render('TMPlatformBundle:Travel:list_travel_map.html.twig', array(
            'code'      => $code,
            'nbTravels' => $nbTravels,
            'travels'   => $travels
        ));
    }
}
