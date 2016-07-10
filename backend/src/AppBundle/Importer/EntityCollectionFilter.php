<?php

namespace AppBundle\Importer;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityCollectionFilter
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    private $logger;

    public function __construct(ValidatorInterface $validator, $logger)
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
                $this->logger->log('debug', "This entity:\n" . print_r($entity, true) . " has these validations:\n " . (string)$violations . "\n");
            }
        }

        return $collectionOutput;
    }

    public function isValid($entity)
    {
        $violations = $this->validator->validate($entity);

        return 0 === count($violations);
    }
}