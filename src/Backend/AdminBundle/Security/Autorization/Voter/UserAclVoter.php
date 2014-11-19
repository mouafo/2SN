<?php

namespace Backend\AdminBundle\Security\Authorization\Voter;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Acl\Voter\AclVoter;

class UserAclVoter extends AclVoter
{
    /**
    * {@InheritDoc}
    */
    public function supportsClass($class)
    {
        // support the Class-Scope ACL for votes with the custom permission map
        // return $class === 'Sonata\UserBundle\Admin\Entity\UserAdmin' || $is_subclass_of($class, 'FOS\UserBundle\Model\UserInterface');
        // if you use php >=5.3.7 you can check the inheritance with is_a($class, 'Sonata\UserBundle\Admin\Entity\UserAdmin');
        // support the Object-Scope ACL
        return is_subclass_of($class, 'FOS\UserBundle\Model\UserInterface');
    }

    public function supportsAttribute($attribute)
    {
        return $attribute === 'EDIT' || $attribute === 'DELETE';
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        if (!$this->supportsClass(get_class($object))) {
            return self::ACCESS_ABSTAIN;
        }

        foreach ($attributes as $attribute) {
            if ($this->supportsAttribute($attribute) && $object instanceof UserInterface) {
                if ($object->isSuperAdmin() && !$token->getUser()->isSuperAdmin()) {
                    // deny a non super admin user to edit a super admin user
                    return self::ACCESS_DENIED;
                }
            }
        }

        // use the parent vote with the custom permission map:
        // return parent::vote($token, $object, $attributes);
        // otherwise leave the permission voting to the AclVoter that is using the default permission map
        return self::ACCESS_ABSTAIN;
    }
}