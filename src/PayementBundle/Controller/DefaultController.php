<?php

namespace PayementBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use PayementBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;
use AppBundle\Entity\User;

class DefaultController extends Controller
{

    /**
     * @Route("/card" , name="pay_show")
     */
    public function indexAction(Request $request)
    {
        $customer = new Customer();
        //Getting Current user
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        \Stripe\Stripe::setApiKey('sk_test_2APKdZmMUOLIX9CiUu3hdB9Z00kd880Rdb');
        $form = $this->get('form.factory')
            ->createNamedBuilder('payment-form')
            ->add('token', HiddenType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('submit', SubmitType::class)
            ->getForm();
        $userRepo = $em->getRepository('PayementBundle:Customer');
        $cust = $userRepo->findOneById($this->container->get('security.token_storage')->getToken()->getUser());
        if ( !empty($cust) ){
           //We are going to render to an existing credit card page
            $RetrievedCustomer = \Stripe\Customer::retrieve('cus_H6186JhVl2FNN8');
            return $this->render('@Payement/Default/myCards.html.twig',["test"=>$RetrievedCustomer]);
        }else{
        //var_dump($cust[0]->getId());
        //Check if email exist then show an other View <<<<
        if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    // Getting Form Data
                    $firstName = $request->request->get('first_name');
                    $lastName = $request->request->get('last_name');
                    $token = $request->request->get("payment-form_token");
                    $userEmail = $user->getEmail();
                    $customer->setEmail($userEmail);
                    $customer->setIduser($this->container->get('security.token_storage')->getToken()->getUser());
                    $customer->setDatecreation(new \DateTime());
                    $customer->setFullname($firstName . " " . $lastName);
                    $stripe_customer = \Stripe\Customer::create([
                        'description' => 'This Client has been created by Fithnitek Project',
                        'source' => 'tok_visa',
                        'email' => $userEmail,
                        'name' => $firstName . " " . $lastName
                    ]);
                    $customer->setId($stripe_customer->id);
                    $em->persist($customer);
                    $em->flush();
                }
            }
        }
        return $this->render('@Payement/Default/payement.html.twig', [
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key')
        ]);
    }


        /**
         * @Route("/charge" , name="chargeCustomer")
         */
        public function chargeAction($customer,$colis,$token){
            \Stripe\Stripe::setApiKey('sk_test_2APKdZmMUOLIX9CiUu3hdB9Z00kd880Rdb');
            $charge = \Stripe\Charge::create([
                'amount' => '1000',
                'currency' => 'usd',
                'customer' => $customer->id,
            ]);

        }


}
