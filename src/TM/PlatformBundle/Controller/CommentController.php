<?php
namespace TM\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TM\PlatformBundle\Entity\Comment;
use TM\PlatformBundle\Entity\Travel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class CommentController
 * @package TM\PlatformBundle\Controller
 */
class CommentController extends Controller
{
    /**
     * @Route("/remove/{id_travel}/{id_comment}")
     * @ParamConverter("travel", class="TMPlatformBundle:Travel", options={"id" = "id_travel"})
     * @ParamConverter("comment", class="TMPlatformBundle:Comment", options={"id" = "id_comment"})
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param Travel $travel
     * @param Comment $comment
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeCommentAction(Request $request, Travel $travel, Comment $comment)
    {
        $this->denyAccessUnlessGranted('delete', $comment);

        $formDeleteComment = $this->get('form.factory')->create();

        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST') && $formDeleteComment->handleRequest($request)->isValid()) {
            $em->remove($comment);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "Commentaire supprimé.");
        }

        return $this->redirectToRoute('tm_platform_view', array(
            'id' => $travel->getId()
        ));
    }
}