<?php

namespace LivraisonBundle\Controller;

use LivraisonBundle\Entity\Livraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LivraisonController extends Controller
{
    /**
     * @Route("/add", name="add_Delivery")
     */
    public function addAction(Request $request)
    {
        $livraison= new Livraison();
        $form=$this->createForm("LivraisonBundle\Form\LivraisonType",$livraison);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($livraison);
            $em->flush();
        }
        return $this->render("@Livraison\Livraison\add.html.twig",["form"=>$form->createView()]);
    }

}
