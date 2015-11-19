<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Song;
use AppBundle\Form\SongType;

/**
 * @RouteResource("Song")
 */
class SongController extends FOSRestController
{
  /**
   * @ApiDoc(
   *   description="Get all songs"
   * )
   */
  public function cgetAction()
  {
    $songs = $this->getDoctrine()
                ->getRepository('AppBundle:Song')
                ->findAll();
    return $songs;
  }

  /**
   * @ApiDoc(
   *   description="Get Song by band, album, song ids"
   * )
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
   * @ApiDoc(
   *   description="Create new song",
   *   input="AppBundle\Form\SongType",
   *   output="AppBundle\Entity\Song"
   * )
   */
  public function postAction(Request $request)
  {
    $song = new Song();

    $this->processForm($song, $request);
  }

  /**
   * @ApiDoc(
   *   description="Update song",
   *   input="AppBundle\Form\SongType"
   * )
   */
  public function putAction(Request $request, $id)
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
   * @ApiDoc(
   *   description="Delete song by id"
   * )
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
      throw new \Exception($form->getErrorsAsString());
    }
  }
}
