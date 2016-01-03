<?php

namespace Emion\UserBundle\Privileges;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;

class PrivilegeService
{
  public function grantPrivileges($dbObject)
  {
    // creating the ACL
    $aclProvider = $this->get('security.acl.provider');
    $objectIdentity = ObjectIdentity::fromDomainObject($dbObject);
    $acl = $aclProvider->createAcl($objectIdentity);

    // retrieving the security identity of the currently logged-in user
    $tokenStorage = $this->get('security.token_storage');
    $user = $tokenStorage->getToken()->getUser();
    
    $securityIdentity = UserSecurityIdentity::fromAccount($user);
    $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
    
    $securityIdentity = new RoleSecurityIdentity("ROLE_MODO");
    $acl->insertClassAce($securityIdentity, MaskBuilder::MASK_OPERATOR);
    $securityIdentity = new RoleSecurityIdentity("ROLE_ADMIN");
    $acl->insertClassAce($securityIdentity, MaskBuilder::MASK_OWNER);
    
    $aclProvider->updateAcl($acl);
  }
}