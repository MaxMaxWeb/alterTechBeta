<?php


namespace App\Controller;

use App\Entity\Apprentis;
use App\Entity\Candidatures;
use App\Entity\Entreprises;
use App\Entity\Offres;
use App\Entity\Reponse;
use App\Entity\User;
use App\Form\AppUpdateType;
use App\Form\CandidType;
use App\Form\EntrepriseType;
use App\Form\EntUpdateType;
use App\Form\OffreType;
use App\Form\ReponseType;
use App\Form\UserType;
use App\Repository\CandidaturesRepository;
use App\Repository\OffresRepository;
use App\Repository\ReponseRepository;
use App\Repository\UserRepository;
use App\Services\FormsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ApprentisRepository;
use App\Repository\EntreprisesRepository;
use App\Form\ApprentisType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\DBAL\Types\TextType;
use App\Repository\MyTypeRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\DefaultController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;


class UserController extends AbstractController

    /**
     * @Route("/signup", name="signup")
     */

{
    public $word;

    private $passwordEncoder;

    private $dCont;






    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;

    }


    public function checkEnt(UserRepository $uRepo){
        $uid = $this->getUser()->getId();
        $u = $uRepo->find($uid);
        return $u->getFicheEntreprise();


    }


 public function signUpAction(Request $request)
 {

     $user = new User();

     $form = $this->createForm(UserType::class, $user);

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {

         $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());

         $user->setPassword($password);
         $user->setRoles(['ROLE_USER']);


         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($user);
         $entityManager->flush();

        return $this->redirectToRoute('login');





     }
     return $this->render('signup.html.twig', ['form' => $form->createView()]);
 }

 public function addOfferAction(UserRepository $userRepository, Request $request, EntreprisesRepository $entrRepo){


        $id = $this->getUser()->getId();

        $user = $userRepository->findOneBy(['id' => $id]);

        $entId = $user->getFicheEntreprise()->getId();

        $ent = $entrRepo->findOneBy(['id' => $entId]);





     if ($user->getFicheApprenti() != null){
         return $this->redirectToRoute('homeAppr');
     }
        $offre = new Offres();

        $form = $this->createForm(OffreType::class, $offre);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $offre->setCreatedAt(new \DateTime());
            $offre->setEntreprises($ent);

            $file = $form->get('image')->getData();
            if($file){
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $offre->setImage($newFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);

            $entityManager->flush();

            return $this->redirectToRoute('homeEntr');

        }


        return $this->render('addOffer.html.twig', ['form' => $form->createView(), 'entId' => $entId]);



 }

 public function updateOffer(Request $request, $id, OffresRepository $offR, UserRepository $uRepo){

        $offre = $offR->find($id);

        $offForm = $this->createForm(OffreType::class, $offre);

        $uid = $this->getUser()->getId();



        $u = $uRepo->find($uid);

        $ent = $u->getFicheEntreprise();
        $entId = $ent->getId();

        if ($u->getFicheEntreprise() !== $offre->getEntreprises()){
            return $this->redirectToRoute('homeEntr');
        }

        $offForm->handleRequest($request);
        if($offForm->isSubmitted()){
            $offre = $offForm->getData();

            $file = $offForm->get('image')->getData();
            if($file){
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $offre->setImage($newFileName);
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($offre);
            $manager->flush();
            return $this->redirectToRoute('homeEntr');
        }

        return $this->render('offreUpdate.html.twig', ['offForm' => $offForm->createView(), 'entId' => $entId] );



 }

    public function seeOffer(OffresRepository $offresRepository, $id, UserRepository $uRepo, CandidaturesRepository $cRep){

        $offre = $offresRepository->findBy(['id' => $id]);
        $uid = $this->getUser()->getId();
        $u = $uRepo->find($uid);
        $app = $u->getFicheApprenti();
        $appId = $app->getId();

        $cand = $cRep->findAll();

        $i = 0;

        foreach ($cand as $c){
            if ($c->getApprentis()->getValues()[0]->getId() == $appId && $c->getReponse() != null){
                if ($c->getReponse()->getChecked() === null)
                    $i++;
            }
        }



        return $this->render('offre.html.twig', ['offre' => $offre, 'appId' => $appId, 'notf' => $i]);

    }

    public function candidAction(CandidaturesRepository $cRep,$id, OffresRepository $offR, Request $req, UserRepository $userR, ApprentisRepository $appR){

        $uid = $this->getUser()->getId();

        $user = $userR->find($uid);
        $offre = $offR->find($id);

        $app = $user->getFicheApprenti();

        $appId = $app->getId();


        $form = $this->createForm(CandidType::class);

        $cand = new Candidatures();

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()){

            $form->getData();
            $cand->setCreatedAt(new \DateTime());
            $cv = $form->get('cv')->getData();
            $ldm = $form->get('lettredemotiv')->getData();
            if($cv){
                $newFileName = FormsManager::handlePdfUpload($cv, $this->getParameter('uploads'));
                $cand->setCv($newFileName);
            }
            if($ldm){
                $nfn = FormsManager::handlePdfUpload($ldm, $this->getParameter('uploads'));
                $cand->setLettredemotiv($nfn);
            }
            if ($offre->getNbCandidats() == null){
                $offre->setNbCandidats(1);
            } else {
                $offre->setNbCandidats($offre->getNbCandidats()+1);
            }
            $cand->setOffres($offre);
            $cand->addApprenti($app);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cand);
            $entityManager->persist($offre);

            $entityManager->flush();


            return $this->redirectToRoute('homeAppr');


        }

        $cand = $cRep->findAll();

        $i = 0;

        foreach ($cand as $c){
            if ($c->getApprentis()->getValues()[0]->getId() == $appId && $c->getReponse() != null){

                if ($c->getReponse()->getChecked() === null)

                    $i++;
            }
        }

        return $this->render('candidAct.html.twig', ['form' => $form->createView(), 'id' => $id, 'off' => $offre, 'appId' => $appId, 'notf' => $i ]);
    }


    public function listCandid($id, CandidaturesRepository $cRepo, OffresRepository $oRepo, EntreprisesRepository $eRepo, UserRepository $uRepo){

        $uid = $this->getUser()->getId();



        $u = $uRepo->find($uid);

        $ent = $u->getFicheEntreprise();

        $entId = $ent->getId();



        $cands = $cRepo->findBy(['offres' => $id]);

        $offre = $oRepo->find($id);

        $e = $eRepo->find($uid);

        if ($offre->getEntreprises() !== $u->getFicheEntreprise()){

           return $this->redirectToRoute('homeEntr');
        }

        return $this->render('listCandid.html.twig', ['of' => $offre, 'cands' => $cands, 'entId' => $entId]);

    }

    public function appProfilAction(CandidaturesRepository $cRep,$id, ApprentisRepository $aRepo){
        $a = $aRepo->find($id);
        $appId = $a->getId();
        $cand = $cRep->findAll();

        $i = 0;

        foreach ($cand as $c){
            if ($c->getApprentis()->getValues()[0]->getId() == $appId && $c->getReponse() != null){
                if ($c->getReponse()->getChecked() === null)
                    $i++;
            }
        }

        return $this->render('appProfil.html.twig', ['appId' => $appId, 'a' => $a, 'notf' => $i]);
    }

    public function upAprofilAction(CandidaturesRepository $cRep, $id, ApprentisRepository $aRepo, Request $request){

        $a = $aRepo->find($id);

        $appId = $a->getId();

        $aForm = $this->createForm(AppUpdateType::class, $a);
            $aForm->handleRequest($request);
        if ($aForm->isSubmitted()){

            $entityManager = $this->getDoctrine()->getManager();




            $entityManager->persist($a);

            $entityManager->flush();

            $cand = $cRep->findAll();

            $i = 0;

            foreach ($cand as $c){
                if ($c->getApprentis()->getValues()[0]->getId() == $appId && $c->getReponse() != null){
                    if ($c->getReponse()->getChecked() === null)
                        $i++;
                }
            }

            return $this->redirectToRoute('appprofil', ['id' => $appId]);
        }



        return $this->render('upAprofil.html.twig', ['form' => $aForm->createView(), 'appId' => $aId]);

    }

    public function entProfilAction($id, EntreprisesRepository $eRepo){
        $e = $eRepo->find($id);
        $eId = $e->getId();

        return $this->render('entProfil.html.twig', ['entId' => $eId, 'e' => $e]);
    }

    public function upEntProfilAction($id, EntreprisesRepository $eRepo, Request $request){
        $e = $eRepo->find($id);
        $eId = $e->getId();

        $eForm = $this->createForm(EntUpdateType::class, $e);


        $eForm->handleRequest($request);
        if ($eForm->isSubmitted()){

            $entityManager = $this->getDoctrine()->getManager();




            $entityManager->persist($e);

            $entityManager->flush();

            return $this->redirectToRoute('entprofil', ['id' => $eId]);
        }
        return $this->render('upEntProfil.html.twig', ['form' => $eForm->createView(), 'entId' => $eId]);


    }

    public function watchAction(PublisherInterface $pub, SerializerInterface $ser , $id, CandidaturesRepository $cRepo, EntreprisesRepository $eRepo, UserRepository $uRepo, Request $request){
        $c = $cRepo->find($id);
        $uId = $this->getUser()->getId();
        $u = $uRepo->find($uId);
        $rep = new Reponse();

        $ent = $u->getFicheEntreprise();
        $app = $c->getApprentis()->getValues()[0]->getId();


        $entId = $ent->getId();

        $repForm = $this->createForm(ReponseType::class, $rep);
        $repForm->handleRequest($request);
        if ( $repForm->isSubmitted() && $repForm->isValid()){
            $rep->setCandidatures($c);
            $c->setReponse($rep);
            $c->setTraite('traitee');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($c);
            $entityManager->persist($rep);
            $entityManager->flush();

            $target = [
                "http://localhost:8000/{$app}",

            ];


            $update = new Update('http://localhost:8000/wtccandid/', json_encode([ $c->getOffres()->getName(), $rep->getMessage(), $rep->getId()])
        , $target);





            $pub($update);














        }

        return $this->render('watchCandid.html.twig', ['c' => $c, 'entId' => $entId, 'form' => $repForm->createView()]);



    }

    public function watchReponse(CandidaturesRepository $cRep, UserRepository $userR){
        $uid = $this->getUser()->getId();

        $user = $userR->find($uid);


        $app = $user->getFicheApprenti();

        $appId = $app->getId();

        $cand = $cRep->findAll();
        $rep = [];
        $listRep = [];
        foreach ($cand as $c){
            if ($c->getApprentis()->getValues()[0]->getId() == $appId){

                if ($c->getReponse() != null){
                    array_push($rep, $c->getReponse());
                }
            }
        }

        foreach ($rep as $r){

            if($r->getChecked() === null){
               $r->setChecked(false);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($r);
                $entityManager->flush();

            }
            array_push($listRep, $r);
        }



        $i = 0;



        return $this->render('reponse.html.twig', ['appId' => $appId, 'notf' => $i, 'lr' => $listRep]);
    }

    /**
     *
     * @Route("/markAsRead", name="markAsRead", methods={"POST"})
     */

    public function markAsRead(UserRepository $uRep, ReponseRepository $rRep)
    {


        $uId = $this->getUser()->getId();
        $u = $uRep->find($uId);
        $app = $u->getFicheApprenti()->getId();

        $rep = $rRep->find($_POST['id']);

        $rep->setChecked(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rep);
        $entityManager->flush();

        return $this->redirectToRoute('reponse');






    }



}
