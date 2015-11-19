<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Band;
use AppBundle\Form\BandType;

/**
 * @RouteResource("Band")
 */
class BandController extends FOSRestController
{
  /**
   * @ApiDoc(
   *   description="Get all bands"
   * )
   */
  public function cgetAction()
  {
    $bands = $this->getDoctrine()
                ->getRepository('AppBundle:Band')
                ->findAll();
    return $bands;
  }

  /**
   * @ApiDoc(
   *   description="Get Band by id"
   * )
   */
  public function getAction($id)
  {
    $band = $this->getDoctrine()
                ->getRepository('AppBundle:Band')
                ->findOneById($id);
    if(!is_object($band)){
      throw $this->createNotFoundException();
    }
    return $band;
  }

  /**
   * @ApiDoc(
   *   description="Create new band",
   *   input="AppBundle\Form\BandType",
   *   output="AppBundle\Entity\Band"
   * )
   */
  public function postAction(Request $request)
  {
    $band = new Band();

    $this->processForm($band, $request);
  }

  /**
   * @ApiDoc(
   *   description="Update band",
   *   input="AppBundle\Form\BandType"
   * )
   */
  public function putAction(Request $request, $id)
  {
    $band = $this->getDoctrine()
                ->getRepository('AppBundle:Band')
                ->findOneById($id);
    if(!is_object($band)){
      throw $this->createNotFoundException();
    }

    $this->processForm($band, $request);
  }

  /**
   * @ApiDoc(
   *   description="Delete band by id"
   * )
   */
  public function deleteAction($id)
  {
    $band = $this->getDoctrine()
                ->getRepository('AppBundle:Band')
                ->findOneById($id);
    if(is_object($band)){
      $em = $this->getDoctrine()->getManager();
      $em->remove($band);
      $em->flush();
    }
  }

  private function processForm(Band $band, $request)
  {
    $form = $this->createForm(new BandType(), $band);
    $form->handleRequest($request);

    if($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($band);
      $em->flush();

    } else {
      throw new \Exception($form->getErrorsAsString());
    }
  }
}
