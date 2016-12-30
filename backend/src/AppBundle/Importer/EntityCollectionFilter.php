<?php

namespace AppBundle\Importer;

use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityCollectionFilter
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    private $logger;

    public function __construct(ValidatorInterface $validator, LoggerInterface $logger)
    {
        $this->validator = $validator;
        $this->logger = $logger;
    }

    public function skipAndLogInvalid(array $collectionInput)
    {
        $collectionOutput = [];
        foreach ($collectionInput as $entity) {
            $violations = $this->validator->validate($entity);
            if (0 === count($violations)) {
                $collectionOutput[] = $entity;
            } else {
                $this->logInvalid($entity, $violations);
            }
        }

        return $collectionOutput;
    }

    public function isValid($entity)
    {
        $violations = $this->validator->validate($entity);

        return 0 === count($violations);
    }

    public function logInvalid($entity, $violations)
    {
        if (method_exists($entity, '__toString')) {
            $entityAsString = (string)$entity;
        } else {
            $entityAsString = print_r($entity, true);
        }
        
        $this->logger->log(
            'debug',
            "This entity:\n".$entityAsString." has these validations:\n ".(string)$violations."\n"
        );
    }
}