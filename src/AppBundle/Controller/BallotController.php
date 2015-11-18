<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Ballot")
 */
class BallotController extends FOSRestController
{
  public function getAction($id)
  {}
}
