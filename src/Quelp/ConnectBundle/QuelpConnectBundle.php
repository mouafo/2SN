<?php

namespace Quelp\ConnectBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class QuelpConnectBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
