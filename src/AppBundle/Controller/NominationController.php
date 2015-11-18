<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Nomination")
 */
class NominationController extends FOSRestController
{
  public function getAction($ballotID, $id)
  {}
}
