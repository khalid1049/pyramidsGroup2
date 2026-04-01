<?php

namespace App\Controller\Admin;

use App\Entity\CustomerRequest;
use App\Entity\RequestedItems;
use App\Entity\ResponseProvider;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AdminDashboard(routePath: '/provider-administration', routeName: 'ProviderAdministration')]
class ProviderDashboardController extends AbstractDashboardController
{
    
    #[Route('/provider-administration', name: 'ProviderAdministration')]
    public function index(): Response
    {
        $user = $this->getUser()->getRoles();

        // dd($user->getRoles()[0]);
        return $this->render('bundles/EasyAdminBundle/views/welcome.html.twig',compact('user'));
       
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
        yield MenuItem::subMenu('Stand Management', 'fa-solid fa-store')
            ->setSubItems([
                // MenuItem::linkToCrud('Stand', 'fa-solid fa-store', Stand::class),
                MenuItem::linkToCrud('Customer Request', 'fa-solid fa-book', CustomerRequest::class),
                MenuItem::linkToCrud('Response Provider', 'fa-solid fa-reply', ResponseProvider::class),
            ]);
    }

    
     public function configureAssets(): Assets
    {   
        return Assets::new()->addCssFile('css/adminCss.css');
            
        
    }

   
}