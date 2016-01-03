<?php

namespace Emion\UserBundle\Privileges;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Acl\Dbal\MutableAclProvider;

class PrivilegeService
{
  private $aclProvider;
  private $tokenStorage;
  
  public function __construct(TokenStorage $tokenStorage, MutableAclProvider $aclProvider)
  {
    $this->tokenStorage = $tokenStorage;
    $this->aclProvider = $aclProvider;
  }
  
  public function grantDefaultPrivileges($dbObject)
  {
    // creating the ACL
    $objectIdentity = ObjectIdentity::fromDomainObject($dbObject);
    $acl = $this->aclProvider->createAcl($objectIdentity);

    $user = $this->tokenStorage->getToken()->getUser();
    
    $securityIdentity = UserSecurityIdentity::fromAccount($user);
    $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
    
    $securityIdentity = new RoleSecurityIdentity("ROLE_MODO");
    $acl->insertClassAce($securityIdentity, MaskBuilder::MASK_OPERATOR);
    $securityIdentity = new RoleSecurityIdentity("ROLE_ADMIN");
    $acl->insertClassAce($securityIdentity, MaskBuilder::MASK_OWNER);
    
    $this->aclProvider->updateAcl($acl);
  }
}