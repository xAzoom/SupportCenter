<?php

namespace AppBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdminPanelController extends Controller
{
    /**
     * @Route(
     *     "/admin/{reactRouting}",
     *     name="admin_mainpanel",
     *     defaults={"reactRouting": null},
     *     requirements={"reactRouting" = ".+"}
     * )
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }
}