<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/exhibitor-administration', routeName: 'exhibitorAdministration')]
class ExhibitorController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/views/welcome.html.twig');
       
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/images/logo.png" style="height:40px;">')
            ->setFaviconPath('/images/logo.png')
            ->disableUrlSignatures();
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

     public function configureAssets(): Assets
    {   
        return Assets::new()
            
            
            ->addCssFile('css/adminCss.css')
            ;
            
       
        
    }
}
