<?php

namespace classes;

use interfaces\iDependenciesContainer;
use ReflectionClass;

class DependenciesContainer implements iDependenciesContainer {
  private static $Instances = array();

  public static function init($ClassName) {
    $Reflection = new ReflectionClass('\classes\\' . $ClassName);
    if (empty(self::$Instances[$ClassName])) {
      self::$Instances[$ClassName] = $Reflection->newInstanceArgs(self::getClassArgs($Reflection));
    }
    return self::$Instances[$ClassName];
  }

  private static function getClassArgs($Reflection) {
    $args = array();
    if ($Reflection->getConstructor()) {
      foreach ($Reflection->getConstructor()
                          ->getParameters() as $param) {
        if (!$param->isOptional()) {
          $ParamInterfaceName = $param->getName();
          $SubReflection = new ReflectionClass('\classes\\' . $ParamInterfaceName);
          $args[] = $SubReflection->newInstanceArgs(self::getClassArgs($SubReflection));
        }
      }
    }
    return $args;
  }
}
