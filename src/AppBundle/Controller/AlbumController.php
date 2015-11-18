<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Album")
 */
class AlbumController extends FOSRestController
{
  public function getAction($bandID, $id)
  {}
}
