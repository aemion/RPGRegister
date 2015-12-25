<?php

namespace Emion\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EmionUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}