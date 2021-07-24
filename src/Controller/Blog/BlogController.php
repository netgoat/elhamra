<?php


namespace App\Controller\Blog;

use App\Entity\Novelty;
use App\Entity\Production;
use App\Entity\Program;
use App\Repository\CarrouselRepository;
use App\Repository\CategoryRepository;
use App\Repository\NoveltyRepository;
use App\Repository\ProductionRepository;
use App\Repository\ProgramRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{


    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index(CarrouselRepository $carrouselRepository, ProgramRepository $programRepository,NoveltyRepository $noveltyRepository,PaginatorInterface $paginator,Request $request):Response {
        $covers = $carrouselRepository->listEnabledCarrousel();
        $news= $paginator->paginate($noveltyRepository->listEnabledNews(),$request->query->getInt('page',1),3);
        $programs= $paginator->paginate($programRepository->listEnabledPrograms(),$request->query->getInt('page',1),4);

        return  $this->render('blog/pages/home.html.twig',[
            'covers'=>$covers ,'news'=>$news,'programs'=>$programs
         ]);
    }

    /**
     * @Route("/espace", name="elhamra_espace")
     * @return Response
     */
    public function espace():Response {
 
        return  $this->render('blog/pages/ELHamra/espace.html.twig');
    }
 

    /**
     * @Route("/fondateur", name="elhamra_fondateur")
     * @return Response
     */
    public function fondateur():Response {
 
        return  $this->render('blog/pages/ELHamra/fondateur.html.twig');
    }
 
 

    /**
     * @Route("/partenaires", name="elhamra_partenaires")
     * @return Response
     */
    public function partenaires():Response {
 
        return  $this->render('blog/pages/ELHamra/partenaires.html.twig');
    }
 

    /**
     * @Route("/saison", name="saison")
     * @return Response
     */
    public function saison( CategoryRepository $categoryRepository, ProgramRepository $programRepository,PaginatorInterface $paginator,Request $request):Response {
        $programs= $paginator->paginate($programRepository->listEnabledPrograms(),$request->query->getInt('page',1),8);

        return  $this->render('blog/pages/programs/list.html.twig',[
            'programs'=>$programs,
            'categories'=> $categoryRepository->findAll(),
        ]);

    }

    /**
     * @Route("/programmation/{slug}", name="program_details")
     * @return Response
     */
    public function programmation(Program $program):Response {
 
             return  $this->render('blog/pages/programs/details.html.twig',[
                'program'=>$program,
             ]);
 
    }


   
     /**
     * @Route("/productions", name="productions")
     * @return Response
     */
    public function productions( CategoryRepository $categoryRepository, ProductionRepository $productionRepository,PaginatorInterface $paginator,Request $request):Response {
        $productions= $paginator->paginate($productionRepository->listEnabledProductions(),$request->query->getInt('page',1),8);

        return  $this->render('blog/pages/productions/list.html.twig',[
            'productions'=>$productions,
            'categories'=> $categoryRepository->findAll(),
        ]);

    }

    /**
     * @Route("/productions/{slug}", name="productions_details")
     * @return Response
     */
    public function production(Production $program):Response {
 
             return  $this->render('blog/pages/productions/details.html.twig',[
                'program'=>$program,
             ]);
 
    }
    

    /**
     * @Route("/araf/presentation", name="araf_presentation")
     * @return Response
     */
    public function araf_presentation():Response {
 
        return  $this->render('blog/pages/ARAF_CENTER/presentation.html.twig');
    }


    /**
     * @Route("/araf/recrutement", name="araf_recrutement")
     * @return Response
     */
    public function araf_recrutement():Response {
 
        return  $this->render('blog/pages/ARAF_CENTER/recrutement.html.twig');
    }

    /**
     * @Route("/festival/2019", name="festival_first_edition")
     * @return Response
     */
    public function festival_first_edition():Response {
 
        return  $this->render('blog/pages/festival/first_edition.html.twig');
    }


    /**
     * @Route("/festival/2020", name="festival_second_edition")
     * @return Response
     */
    public function festival_second_edition():Response {
 
        return  $this->render('blog/pages/festival/second_edition.html.twig');
    }


    /**
     * @Route("/news", name="newspage")
     * @return Response
     */
    public function news ( CategoryRepository $categoryRepository, NoveltyRepository $noveltyRepository,PaginatorInterface $paginator,Request $request):Response {
            $news= $paginator->paginate($noveltyRepository->listEnabledNews(),$request->query->getInt('page',1),8);
    
            return  $this->render('blog/pages/news/list.html.twig',[
                'news'=>$news,
                'categories'=> $categoryRepository->findAll(),
            ]);
     }


      /**
     * @Route("/news/{slug}", name="news_details")
     * @return Response
     */
    public function news_details(Novelty $novelty):Response {
 
        return  $this->render('blog/pages/news/details.html.twig',[
           'novelty'=>$novelty,
        ]);

}

    /**
     * @Route("/contact", name="contactpage")
     * @return Response
     */
    public function contact():Response {
        return  $this->render('blog/pages/contact.html.twig');
    }



}