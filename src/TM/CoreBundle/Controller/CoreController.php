<?php

	namespace TM\CoreBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;
    use TM\PlatformBundle\Form\TravelSearchType;

    class CoreController extends Controller
	{
		// La page d'accueil
		public function indexAction(Request $request)
		{
            $form = $this->createForm(TravelSearchType::class);

            if($request->getMethod() == 'POST' && $form->handleRequest($request)->isValid())

            {



                    $em = $this->getDoctrine()->getManager();

                    //On récupère les données entrées dans le formulaire par l'utilisateur


                    $data =$request->request->get($form->getName());


                    //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

                    $liste_annonces = $em->getRepository('TMPlatformBundle:Travel')->findTravelByParametres($data);

                    //Puis on redirige vers la page de visualisation de cette liste d'annonces

                return $this->render('TMPlatformBundle:Travel:index.html.twig', array(
                    'travels' => $liste_annonces,
                    'nbPages'     => 8,
                    'page'        => 1,
                ));



            }
			// On retourne simplement la vue de la page d'accueil
			// L'affichage des 3 dernières annonces utilisera le contrôleur déjà existant dans PlatformBundle
			return $this->render('TMCoreBundle:Core:index.html.twig', array('form' => $form->createView()));

			// La méthode longue $this->get('templating')->renderResponse('...') est parfaitement valable
		}

		// La page de contact
		public function contactAction(Request $request)
		{
			// On récupère la session depuis la requête, en argument du contrôleur
			$session = $request->getSession();
			// Et on définit notre message
			$session->getFlashBag()->add('info', 'La page de contact n’est pas encore disponible, merci de revenir plus tard.');

			// Enfin, on redirige simplement vers la page d'accueil
			return $this->redirectToRoute('tm_core_homepage');

			// La méthode longue new RedirectResponse($this->get('router')->generate('oc_core_home')); est parfaitement valable
		}
	}
