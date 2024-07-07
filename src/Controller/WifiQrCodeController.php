<?php

namespace App\Controller;

use App\Form\WifiFormType;
use chillerlan\QRCode\QRCode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class WifiQrCodeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function create(Request $request,RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $form = $this->createForm(WifiFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $wifiParams = $form->getData();
            $nom = $wifiParams['nom'];
            $encryption = $wifiParams['encryption'];
            $hidden = $wifiParams['hidden'];
            $mdp = $wifiParams['mdp'];
            $data = "WIFI:T:$encryption;S:$nom;P:$mdp;H:$hidden;";
            $img =  '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';
            $session->set("img",$img);
            return $this->redirectToRoute('app_show');
        }
        return $this->render('wifi_qr_code/create.html.twig',compact('form'));
    }
    #[Route('/wifi/show', name: 'app_show')]
    public function show(Request $request,RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $img = $session->get('img');
        if($img){
            //$session->remove('img');
            return $this->render('wifi_qr_code/show.html.twig',[
                'img' => $img
            ]);
        }else{
            $this->addFlash("danger","Entrer d'abord les paramètres");
            return $this->redirectToRoute('app_home');
        }
    }
}
