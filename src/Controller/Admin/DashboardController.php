<?php

namespace App\Controller\Admin;

use App\Entity\Carrousel;
use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Novelty;
use App\Entity\Production;
use App\Entity\Program;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(CarrouselCrudController::class)->generateUrl());      }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('El Hamra');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home' );
        
        yield MenuItem::section( );
        yield MenuItem::subMenu('Website', 'fa fa-map-o')->setSubItems([
            MenuItem::linkToCrud ('Carrousel', 'fa fa-picture-o ',Carrousel::class ),
        ]);
        yield MenuItem::section( ); 

        yield  MenuItem::linkToCrud ('Prods', 'fa fa-university',Production::class ) ;
        yield MenuItem::section( ); 

        yield  MenuItem::linkToCrud ('News', 'fa fa-newspaper-o',Novelty::class) ;
        yield MenuItem::section( ); 

        yield MenuItem::subMenu('la saison', 'fa fa-map-o')->setSubItems([
            MenuItem::linkToCrud ('2020-2021', 'fa fa-cubes', Program::class) 
        ]);
  
        yield MenuItem::section( ); 
 
        yield MenuItem::linkToCrud('Categories', 'fa fa-bookmark', Category::class);
        yield MenuItem::section( ); 
 
  
 

    }
}

