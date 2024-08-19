<?php

namespace App\Common;

final class SubscribtionStatus {
  const WAITING = 0;
  const ACTIVE = 1;
  const EXPIRED = 2;
  const CANCELED_BY_ADMIN = 3;
  const CANCELED_BY_USER = 4;
}