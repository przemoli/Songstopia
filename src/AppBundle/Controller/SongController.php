<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\SongType;

/**
 * @RouteResource("Song")
 */
class SongController extends FOSRestController
{
  /**
   * @ApiDoc()
   */
  public function getAction($songID, $albumID, $id)
  {
    $song = $this->getDoctrine()
                ->getRepository('AppBundle:Song')
                ->findOneById($id);
    if(!is_object($song)){
      throw $this->createNotFoundException();
    }
    return $song;
  }

  /**
   * @ApiDoc()
   */
  public function postAction()
  {
    $song = new Song();

    $this->processForm($song, $request);
  }

  /**
   * @ApiDoc()
   */
  public function putAction()
  {
    $song = $this->getDoctrine()
                ->getRepository('AppBundle:Song')
                ->findOneById($id);
    if(!is_object($song)){
      throw $this->createNotFoundException();
    }

    $this->processForm($song, $request);
  }

  /**
   * @ApiDoc()
   */
  public function deleteAction($id)
  {
    $song = $this->getDoctrine()
                ->getRepository('AppBundle:Song')
                ->findOneById($id);
    if(is_object($song)){
      $song->getAlbum()
        ->removeSong($song);

      $em = $this->getDoctrine()->getManager();
      $em->remove($song);
      $em->flush();
    }
  }

  private function processForm(Song $song, $request)
  {
    $form = $this->createForm(new SongType(), $song);
    $form->handleRequest($request);

    if($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($song);
      $em->flush();

    } else {

    }
  }
}
