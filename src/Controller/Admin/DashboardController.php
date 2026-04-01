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
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index(): Response
    {
        $user = $this->getUser()->getRoles();
       
        return $this->render('bundles/EasyAdminBundle/views/welcome.html.twig', [
        'user' => $user, 
        'usersCount' => $this->em->getRepository(User::class)->count([]),
        'exhibitorsCount' => $this->em->getRepository(Exhibitor::class)->count([]),
        'providersCount' => $this->em->getRepository(Provider::class)->count([]),
        'customerRequestsCount' => $this->em->getRepository(CustomerRequest::class)->count([]),
    ]);
        // return $this->render('admin/dashboard.html.twig');

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

        yield MenuItem::subMenu('Users Management', 'fa-solid fa-users')
            ->setSubItems([
                MenuItem::linkToCrud('User', 'fa-solid fa-user', User::class),
                MenuItem::linkToCrud('Exhibitor','fa-solid fa-user-tie', Exhibitor::class),
                MenuItem::linkToCrud('Provider', 'fa-solid fa-briefcase', Provider::class),
            ]);

        yield MenuItem::subMenu('Stand Management', 'fa-solid fa-store')
            ->setSubItems([
                MenuItem::linkToCrud('Stand', 'fa-solid fa-store', Stand::class),
                MenuItem::linkToCrud('Customer Request', 'fa-solid fa-book', CustomerRequest::class),
                MenuItem::linkToCrud('Response Provider', 'fa-solid fa-reply', ResponseProvider::class),
            ]);
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
