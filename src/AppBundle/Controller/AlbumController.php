<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\AlbumType;

/**
 * @RouteResource("Album")
 */
class AlbumController extends FOSRestController
{
  /**
   * @ApiDoc(
   *   description="Get Album by band, album ids"
   * )
   */
  public function getAction($albumID, $id)
  {
    $album = $this->getDoctrine()
                ->getRepository('AppBundle:Album')
                ->findOneById($id);
    if(!is_object($album)){
      throw $this->createNotFoundException();
    }
    return $album;
  }

  /**
   * @ApiDoc(
   *   description="Create new album",
   *   input="AppBundle\Form\AlbumType",
   *   output="AppBundle\Entity\Album"
   * )
   */
  public function postAction()
  {
    $album = new Album();

    $this->processForm($album, $request);
  }

  /**
   * @ApiDoc(
   *   description="Update album",
   *   input="AppBundle\Form\AlbumType"
   * )
   */
  public function putAction()
  {
    $album = $this->getDoctrine()
                ->getRepository('AppBundle:Album')
                ->findOneById($id);
    if(!is_object($album)){
      throw $this->createNotFoundException();
    }

    $this->processForm($album, $request);
  }

  /**
   * @ApiDoc(
   *   description="Delete album by id"
   * )
   */
  public function deleteAction($id)
  {
    $album = $this->getDoctrine()
                ->getRepository('AppBundle:Album')
                ->findOneById($id);
    if(is_object($album)){
      $album->getAlbum()
        ->removeAlbum($album);

      $em = $this->getDoctrine()->getManager();
      $em->remove($album);
      $em->flush();
    }
  }

  private function processForm(Album $album, $request)
  {
    $form = $this->createForm(new AlbumType(), $album);
    $form->handleRequest($request);

    if($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($album);
      $em->flush();

    } else {

    }
  }
}
