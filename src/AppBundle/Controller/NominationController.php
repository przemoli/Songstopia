<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\NominationType;

/**
 * @RouteResource("Nomination")
 */
class NominationController extends FOSRestController
{
  /**
   * @ApiDoc()
   */
  public function getAction($ballotID, $id)
  {
    $nomination = $this->getDoctrine()
                ->getRepository('AppBundle:Nomination')
                ->findOneById($id);
    if(!is_object($nomination)){
      throw $this->createNotFoundException();
    }
    return $nomination;
  }

  /**
   * @ApiDoc()
   */
  public function postAction()
  {
    $nomination = new Nomination();

    $this->processForm($nomination, $request);
  }

  /**
   * @ApiDoc()
   */
  public function putAction()
  {
    $nomination = $this->getDoctrine()
                ->getRepository('AppBundle:Nomination')
                ->findOneById($id);
    if(!is_object($nomination)){
      throw $this->createNotFoundException();
    }

    $this->processForm($nomination, $request);
  }

  /**
   * @ApiDoc()
   */
  public function deleteAction($id)
  {
    $nomination = $this->getDoctrine()
                ->getRepository('AppBundle:Nomination')
                ->findOneById($id);
    if(is_object($nomination)){
      $nomination->getBallot()
        ->removeNomination($nomination);

      $em = $this->getDoctrine()->getManager();
      $em->remove($nomination);
      $em->flush();
    }
  }

  private function processForm(Nomination $nomination, $request)
  {
    $form = $this->createForm(new NominationType(), $nomination);
    $form->handleRequest($request);

    if($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($nomination);
      $em->flush();

    } else {

    }
  }
}
