<?php

namespace TM\CoreBundle\Breadcrumbs;

/**
 * Class Breadcrumbs
 * @package TM\CoreBundle\Breadcrumbs
 */
class Breadcrumbs
{
    /**
     * @var
     */
    private $breadcrumbs;

    /**
     * Breadcrumbs constructor.
     * @param $breadcrumbs
     */
    public function __construct($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     *
     */
    public function home()
    {
        $this->breadcrumbs->addRouteItem("Accueil", "tm_core_index");
    }

    /**
     * @param $id
     */
    public function viewTravel($id)
    {
        $this->home();
        $this->breadcrumbs->addRouteItem("Détail du voyage", "tm_platform_view", [
            'id' => $id
        ]);
    }

    /**
     *
     */
    public function listTravel()
    {
        $this->home();
        $this->breadcrumbs->addRouteItem("Liste des voyages", "tm_platform_search");
    }

    /**
     *
     */
    public function addTravel()
    {
        $this->home();
        $this->breadcrumbs->addRouteItem("Ajouter un voyage", "tm_platform_add");
    }

    /**
     * @param $id
     */
    public function editTravel($id)
    {
        $this->viewTravel($id);
        $this->breadcrumbs->addRouteItem("Modifier un voyage", "tm_platform_edit", [
            'id' => $id
        ]);
    }

    public function map()
    {
        $this->home();
        $this->breadcrumbs->addRouteItem("Carte du monde", "tm_platform_map");
    }
}