<?php


namespace App\Controller;


use App\Entity\Apprentis;
use App\Entity\Candidatures;
use App\Entity\Entreprises;
use App\Entity\Niveau;
use App\Entity\User;
use App\Form\ApprentisType;
use App\Form\EntrepriseType;
use App\Repository\ApprentisRepository;
use App\Repository\CandidaturesRepository;
use App\Repository\EntreprisesRepository;
use App\Repository\OffresRepository;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MyTypeRepository;

class DefaultController extends AbstractController
{
    public $myType;



    public function checkEntr($user){
        if ($user->getFicheEntreprise() != null){
            return $this->redirectToRoute('homeEntr');
        }
        return $this->redirectToRoute('homeAppr');


    }

    public function checkAppr($user){
        if ($user->getFicheApprenti() != null){
            return $this->redirectToRoute('homeAppr');
        }
        return $this->redirectToRoute('homeEntr');
    }

    public function homeAction(UserRepository $userRepository, ApprentisRepository $apprRepo, Request $request){

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $id = $this->getUser()->getId();
        } else {
            return $this->redirectToRoute('login');
        }

        $user = $userRepository->findOneBy(['id' => $id]);



        if ($user->getFicheApprenti() == null && $user->getFicheEntreprise() == null){


            $apprentis = new Apprentis();



            $formAppr = $this->createForm(ApprentisType::class, $apprentis);

            $formAppr->handleRequest($request);


            if($formAppr->isSubmitted() && $formAppr->isValid()){



                $user->setFicheApprenti($apprentis);




                $entityManager = $this->getDoctrine()->getManager();


                $entityManager->persist($user);

                $entityManager->persist($apprentis);

                $entityManager->flush();

                return $this->redirectToRoute('home');
            }
            $entreprise = new Entreprises();
            $formEntr = $this->createForm(EntrepriseType::class, $entreprise);

            $formEntr->handleRequest($request);

            if($formEntr->isSubmitted() && $formEntr->isValid()){

                $user->setFicheEntreprise($entreprise);


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->persist($entreprise);
                $entityManager->flush();

                return $this->redirectToRoute('homeEntr');
            }



            return $this->render('fiche.html.twig', ['formEntr' => $formEntr->createView(), 'formAppr' => $formAppr->createView()]);
        } else {
            if($this->checkEntr($user)) {
                return $this->checkEntr($user);
            }else{
                return $this->checkAppr($user);
            }


        }


    }




    public function homeEntrAction(UserRepository $userRepository, EntreprisesRepository $entrRepo, OffresRepository $offR, CandidaturesRepository $cR){
        $id = $this->getUser()->getId();


        $u = $userRepository->find($id);

        if ($u->getFicheApprenti() != null){
            return $this->redirectToRoute('homeAppr');
        }


        $user = $userRepository->findOneBy(['id' => $id]);




        $id = $this->getUser()->getId();

        $user = $userRepository->findOneBy(['id' => $id]);

        $entId = $user->getFicheEntreprise()->getId();

        $offres = $offR->findBy(['entreprises' => $entId]);

        foreach ($offres as $offre){
            $desLen = strlen($offre->getDescription());

        }
        $cnd = [];
        $cand = $cR->findAll();
        foreach ($cand as $c){
            foreach ($offres as $o)
            if ($c->getOffres()->getId() == $o->getId()){
                array_push($cnd, $c );
            }
        }

        $cLen = count($cnd);


        $len = count($offres);











        return $this->render('homeEntr.html.twig', ['offres' => $offres, 'len' => $len, 'clen' => $cLen, 'entId' => $entId]);

    }

    public function homeApprAction(UserRepository $userRepository, OffresRepository $offresRepository, CandidaturesRepository $cRep, ApprentisRepository $appR, Request $request){
        $id = $this->getUser()->getId();

        $u = $userRepository->find($id);

        if ($u->getFicheEntreprise() != null){
            return $this->redirectToRoute('homeEntr');
        }



        $user = $userRepository->findOneBy(['id' => $id]);


        $uApp = $user->getFicheApprenti();
        $uCom = $uApp->getCompetences()->getValues();
        $appId = $uApp->getId();


        $cand = $uApp->getCandidatures()->getValues();




        $offres = $offresRepository->findAll();

        $oCom = [];
        foreach ($offres as $offre){
            $oC = $offre->getCompetences()->getValues();
            array_push($oCom, $oC);

        }
        $offresCompatibles = [];
        $cnt = 0;

        foreach ($oCom as $oCM){

            foreach ($oCM as $o){

                foreach ($uCom as $u){

                    if($u->getId() == $o->getId()){



                        array_push($offresCompatibles, $o);

                    }
                }
            }
        }
            $offPrU = [];

            foreach ($offresCompatibles as $test){

                $target = $test->getOffres()->getValues();


                    }



        if(!empty($target)){
        array_push($offPrU, $target);
        } else {
            $target = [];
        }

        $dsp = null;

        if (count($offPrU) > 0) {
            $len = count($offPrU[0]);
        } else {
            $len = 0;
        }
        $candLen = count($cand);









       return $this->render('homeAppr.html.twig', ['offres' => $target,
            'len'=> $len,
            'cnt' => $cnt,
            'user' => $uApp,
            'cand' => $cand,
            'candLen' => $candLen,
            'dsp' => $dsp,
            'appId' => $appId
        ]);




    }
}

