<?php

namespace App\Controller\Admin;

use App\Entity\CustomerRequest;
use App\Entity\Event;
use App\Entity\Exhibitor;
use App\Entity\Provider;
use App\Entity\RequestedItems;
use App\Entity\ResponseProvider;
use App\Entity\Stand;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
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
        yield MenuItem::linkToCrud('Stand', 'fa-solid fa-store', Stand::class);
        yield MenuItem::linkToCrud('Event', 'fa-solid fa-calendar-days', Event::class);
        yield MenuItem::linkToCrud('Exhibitor','fa-solid fa-user-tie', Exhibitor::class);
        yield MenuItem::linkToCrud('User', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Provider', 'fa-solid fa-briefcase', Provider::class);
        yield MenuItem::linkToCrud('Requested Items', 'fa-solid fa-list', RequestedItems::class);
        yield MenuItem::linkToCrud('customer Request', 'fa-solid fa-book', CustomerRequest::class);
        yield MenuItem::linkToCrud('Response Provider', 'fa-solid fa-reply', ResponseProvider::class);




    }

    public function configureAssets(): Assets
    {   
        return Assets::new()
            
            // ->addHtmlContentToHead('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">')

            // ->addJsFile('Js/jquery.min.js')
            // ->addJsFile('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')
            // ->addJsFile('js/adminJs.js')
            ->addCssFile('css/adminCss.css')
            ->addJsFile('js/adminJs.js')

            ;
            
       
        
    }
}
