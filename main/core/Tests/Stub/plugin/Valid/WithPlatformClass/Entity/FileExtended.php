<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Valid\WithPlatformClass\Entity;

use Claroline\CoreBundle\Entity\Resource\AbstractResource;

/**
 * @ORM\Entity
 * @ORM\Table(name="valid_custom_resource_a")
 */
class FileExtended extends AbstractResource
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $someField;

    public function getSomeField()
    {
        return $this->someField;
    }

    public function setSomeField($value)
    {
        $this->someField = $value;
    }
}
