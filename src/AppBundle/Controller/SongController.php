<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Song")
 */
class SongController extends FOSRestController
{
  public function getAction($bandID, $albumID, $id)
  {}
}
