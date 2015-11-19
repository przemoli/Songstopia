<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\BandType;

/**
 * @RouteResource("Band")
 */
class BandController extends FOSRestController
{
  /**
   * @ApiDoc()
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
   * @ApiDoc()
   */
  public function postAction(Request $request)
  {
    $band = new Band();

    $this->processForm($band, $request);
  }

  /**
   * @ApiDoc()
   */
  public function putAction($id, Request $request)
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
   * @ApiDoc()
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

    }
  }
}
