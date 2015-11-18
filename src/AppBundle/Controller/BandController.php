<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Band")
 */
class BandController extends FOSRestController
{
  public function getAction($id)
  {}
}
