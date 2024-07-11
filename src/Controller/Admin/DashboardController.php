<?php

namespace App\Controller\Admin;

use App\Entity\Activityarea;
use App\Entity\APropos;
use App\Entity\Contacts;
use App\Entity\Events;
use App\Entity\HomePage;
use App\Entity\Mentionslegales;
use App\Entity\Prosuccess;
use App\Entity\Resources;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Espace Administrateur')
            ->renderContentMaximized() // permet d'afficher le crud controller tout le long
        ;
    }

    // chemins du dashboard
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Histoires Inspirantes', 'fas fa-book', Prosuccess::class);
        yield MenuItem::linkToCrud('Gestion Utilisateurs', 'fas fa-users', Users::class);
        yield MenuItem::linkToCrud('Secteurs d\'Activités', 'fas fa-rectangle-list', Activityarea::class);
        yield MenuItem::linkToCrud('Ressources Éducatives', 'fas fa-newspaper', Resources::class);
        yield MenuItem::linkToCrud('Évènements', 'fas fa-calendar', Events::class);
        yield MenuItem::linkToCrud('Contact / Support', 'fas fa-envelope', Contacts::class);
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Page d\'accueil', 'fas fa-file', HomePage::class);
        yield MenuItem::linkToCrud('A Propos', 'fas fa-info', APropos::class);
        yield MenuItem::linkToCrud('Mentions légales', 'fas fa-book-bookmark', Mentionslegales::class);
        yield MenuItem::section();
        yield MenuItem::linkToRoute('Retour Accueil', 'fas fa-home', 'app_home');
    }
}
