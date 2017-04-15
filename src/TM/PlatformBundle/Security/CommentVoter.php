<?php

namespace TM\PlatformBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use TM\PlatformBundle\Entity\Comment;
use TM\UserBundle\Entity\User;

/**
 * Class CommentVoter
 * @package TM\PlatformBundle\Security
 */
class CommentVoter extends Voter
{
    /**
     *
     */
    const DELETE = 'delete';
    /**
     *
     */
    const EDIT = 'edit';

    /**
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    /**
     * TravelVoter constructor.
     * @param AccessDecisionManagerInterface $decisionManager
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::DELETE, self::EDIT))) {
            return false;
        }
        if (!$subject instanceof Comment) {
            return false;
        }
        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($subject, $user);
            case self::EDIT:
                return $this->canEdit($subject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    /**
     * @param Comment $comment
     * @param User $user
     * @return bool
     */
    private function canDelete(Comment $comment, User $user)
    {
        if (!$user->hasRole('ROLE_USER')) {
            return false;
        }
        if ($user !== $comment->getUser()) {
            return false;
        }
        return true;
    }

    /**
     * @param Comment $comment
     * @param User $user
     * @return bool
     */
    private function canEdit(Comment $comment, User $user)
    {
        if (!$user->hasRole('ROLE_USER')) {
            return false;
        }
        if ($user !== $comment->getUser()) {
            return false;
        }
        return true;
    }
}
