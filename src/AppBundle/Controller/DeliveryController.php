<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\delivery;
use AppBundle\Entity\Returns;

class DeliveryController extends Controller
{
    /**
     * @Route("/showDeliveries", name="showDeliveries")
     */
    public function showDeliveriesAction()
    {
        $user = $this->getUser();
        $deliveries = $this->getDoctrine()->getRepository(delivery::class)->getUserDeliveries($user->getId());

        return $this->render('@App/Delivery/show_deliveries.html.twig', array(
            'deliveries' => $deliveries,
            'username' => $user->getUsername()
        ));
    }

    /**
     * @Route("/returnBook/{delivery_id}", name="returnBook")
     */
    public function returnBookAction($delivery_id){
      $em = $this->getDoctrine()->getManager();
      $delivery = $em->getRepository(delivery::class)->findOneById($delivery_id);

      if (!$delivery) {
        throw $this->createNotFoundException(
            'No se encuentra el prestamo con id: '.$delivery_id
        );
      }
      $delivery->setIsReturned(TRUE);
      $returns = new Returns();
      $returns->setDateReturn(new \DateTime(date('Y-m-d')));
      $returns->setDelivery($delivery);
      $em->persist($returns);
      $em->flush();

      $this->addFlash('success','Se ha realizado la solicitud con éxito');
      return $this->redirectToRoute('showDeliveries');
    }
}
