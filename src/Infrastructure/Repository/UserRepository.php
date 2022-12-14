<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValuesObject\User;
use App\Infrastructure\Builder\User\UserEntityBuilder;
use App\Infrastructure\DAO\ORM\User as UserEntity;
use App\Infrastructure\Exception\User\EmailAlreadyInUseException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;


class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserRepositoryInterface
{


    public function __construct(ManagerRegistry $registry,
                                private readonly UserEntityBuilder $userEntityBuilder
    )
    {
        parent::__construct($registry, UserEntity::class);
    }



    /**
     * @throws EmailAlreadyInUseException
     */
    public function save(User $user, bool $flush = true): void
    {
        $userEntity = $this->userEntityBuilder->build($user);
        $this->getEntityManager()->persist($userEntity);
        if ($flush) {
            try {
                $this->getEntityManager()->flush();
            } catch (UniqueConstraintViolationException $exception) {
                throw new EmailAlreadyInUseException();
            }
        }
    }


    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof UserEntity) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

//        $this->save($user, true);
    }


}
