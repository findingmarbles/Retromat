<?php

namespace AppBundle\Importer;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityCollectionFilter
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function skipAndLogInvalid(array $collectionInput)
    {
        $collectionOutput = [];
        foreach ($collectionInput as $entity) {
            $violations = $this->validator->validate($entity);
            if (0 === count($violations)) {
                $collectionOutput[] = $entity;
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