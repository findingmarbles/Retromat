<?php

namespace AppBundle\Importer;

class ArrayToObjectMapper
{
    public function fillObjectFromArray($inputArray, $objectToFill)
    {
        foreach ($inputArray as $property => $value) {
            // method names and are case insensitive by nature
            $methodName = sprintf('set%s', $property);
            if (method_exists($objectToFill, $methodName)) {
                // method names can be specified in a variable
                $objectToFill->$methodName($value);
            }
        }

        return $objectToFill;
    }
}