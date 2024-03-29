<?php

namespace AppBundle\Form\Transformer;

use AppBundle\Entity\LinkGroup;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transforms LinkGroup name to Object
 */
class LinkGroupTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($linkgroup)
    {
        if ($linkgroup instanceof LinkGroup) {
            return $linkgroup->getTitle();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($groupTitle)
    {
        if (!$groupTitle) {
            return;
        }
        $linkgroup = $this->manager->getRepository('AppBundle:LinkGroup')->findOneByTitle($groupTitle);

        if (null === $linkgroup) {
            throw new TransformationFailedException(sprintf('An issue with number "%s" does not exist!', $groupTitle));
        }
        return $linkgroup;
    }
}
