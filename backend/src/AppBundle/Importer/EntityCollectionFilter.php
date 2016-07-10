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

    public function isValid($entity)
    {
        $violations = $this->validator->validate($entity);

        return 0 === count($violations);
    }
}