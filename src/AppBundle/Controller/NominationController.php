<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * @RouteResource("Nomination")
 */
class NominationController extends FOSRestController
{
  /**
   * @ApiDoc()
   */
  public function getAction($ballotID, $id)
  {}

  /**
   * @ApiDoc()
   */
  public function postAction()
  {}

  /**
   * @ApiDoc()
   */
  public function putAction()
  {}

  /**
   * @ApiDoc()
   */
  public function deleteAction($id)
  {}
}
