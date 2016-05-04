<?php

namespace Securetrading\Config;

interface ConfigInterface {
  function has($key);
  function get($key);
  function set($key, $value);
  function toArray();
}