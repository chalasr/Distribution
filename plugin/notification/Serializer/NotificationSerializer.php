<?php

namespace  Icap\NotificationBundle\Serializer;

use Claroline\AppBundle\API\Options;
use Claroline\AppBundle\Persistence\ObjectManager;
use Claroline\CoreBundle\API\Serializer\User\UserSerializer;
use Claroline\CoreBundle\Entity\User;
use Claroline\CoreBundle\Library\Normalizer\DateNormalizer;
use Icap\NotificationBundle\Entity\Notification;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @DI\Service("claroline.serializer.notification")
 * @DI\Tag("claroline.serializer")
 */
class NotificationSerializer
{
    /** @var ObjectManager */
    private $om;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var UserSerializer */
    private $userSerializer;

    /**
     * NotificationSerializer constructor.
     *
     * @DI\InjectParams({
     *     "om"              = @DI\Inject("claroline.persistence.object_manager"),
     *     "eventDispatcher" = @DI\Inject("event_dispatcher"),
     *     "userSerializer"  = @DI\Inject("claroline.serializer.user")
     * })
     *
     * @param ObjectManager            $om
     * @param EventDispatcherInterface $eventDispatcher
     * @param UserSerializer           $userSerializer
     */
    public function __construct(
        ObjectManager $om,
        EventDispatcherInterface $eventDispatcher,
        UserSerializer $userSerializer
    ) {
        $this->om = $om;
        $this->eventDispatcher = $eventDispatcher;
        $this->userSerializer = $userSerializer;
    }

    public function getClass()
    {
        return Notification::class;
    }

    public function serialize(Notification $notification)
    {
        /** @var User $user */
        $user = $this->om->getRepository(User::class)->find($notification->getUserId());

        return [
            'id' => $notification->getId(),

            'meta' => [
                'creator' => !empty($user) ? $this->userSerializer->serialize($user, [Options::SERIALIZE_MINIMAL]) : null,
                'created' => DateNormalizer::normalize($notification->getCreationDate()),
            ],

            'action' => $notification->getActionKey(),
            'details' => $notification->getDetails(),
        ];
    }
}