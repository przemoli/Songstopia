<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\BallotType;

/**
 * @RouteResource("Ballot")
 */
class BallotController extends FOSRestController
{
  /**
   * @ApiDoc()
   */
  public function getAction($id)
  {
    $ballot = $this->getDoctrine()
                ->getRepository('AppBundle:Ballot')
                ->findOneById($id);
    if(!is_object($ballot)){
      throw $this->createNotFoundException();
    }
    return $ballot;
  }

  /**
   * @ApiDoc()
   */
  public function postAction()
  {
    $ballot = new Ballot();

    $this->processForm($ballot, $request);
  }

  /**
   * @ApiDoc()
   */
  public function putAction()
  {
    $ballot = $this->getDoctrine()
                ->getRepository('AppBundle:Ballot')
                ->findOneById($id);
    if(!is_object($ballot)){
      throw $this->createNotFoundException();
    }

    $this->processForm($ballot, $request);
  }

  /**
   * @ApiDoc()
   */
  public function deleteAction($id)
  {
    $ballot = $this->getDoctrine()
                ->getRepository('AppBundle:Ballot')
                ->findOneById($id);
    if(is_object($ballot)){
      $em = $this->getDoctrine()->getManager();
      $em->remove($ballot);
      $em->flush();
    }
  }

  private function processForm(Ballot $ballot, $request)
  {
    $form = $this->createForm(new BallotType(), $ballot);
    $form->handleRequest($request);

    if($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($ballot);
      $em->flush();

    } else {

    }
  }
}
