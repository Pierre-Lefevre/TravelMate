<?php
namespace TM\CoreBundle\Controller;

class Breadcrumb
{
    private $breadcrumbs;

    public function __construct($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function home()
    {
        $this->breadcrumbs->addRouteItem("Accueil", "tm_core_home");
    }

    public function viewTravel($id)
    {
        $this->home();
        $this->breadcrumbs->addRouteItem("Détail du voyage", "tm_platform_view", [
            'id' => $id
        ]);
    }

    public function addTravel()
    {
        $this->home();
        $this->breadcrumbs->addRouteItem("Ajouter un voyage", "tm_platform_add");
    }

    public function editTravel($id)
    {
        $this->view($id);
        $this->breadcrumbs->addRouteItem("Modifier un voyage", "tm_platform_edit", [
            'id' => $id
        ]);
    }
}