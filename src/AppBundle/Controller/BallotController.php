<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Ballot;
use AppBundle\Form\BallotType;

/**
 * @RouteResource("Ballot")
 */
class BallotController extends FOSRestController
{
  /**
   * @ApiDoc(
   *   description="Get all ballots"
   * )
   */
  public function cgetAction()
  {
    $ballots = $this->getDoctrine()
                ->getRepository('AppBundle:Ballot')
                ->findAll();
    return $ballots;
  }

  /**
   * @ApiDoc(
   *   description="Get Ballot by id"
   * )
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
   * @ApiDoc(
   *   description="Create new ballot",
   *   input="AppBundle\Form\BallotType",
   *   output="AppBundle\Entity\Ballot"
   * )
   */
  public function postAction(Request $request)
  {
    $ballot = new Ballot();

    $this->processForm($ballot, $request);
  }

  /**
   * @ApiDoc(
   *   description="Update ballot",
   *   input="AppBundle\Form\BallotType"
   * )
   */
  public function putAction(Request $request, $id)
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
   * @ApiDoc(
   *   description="Delete ballot by id"
   * )
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
      throw new \Exception($form->getErrorsAsString());
    }
  }
}
