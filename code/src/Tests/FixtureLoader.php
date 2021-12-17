<?php

namespace App\Tests;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class FixtureLoader
{
    private $entityManager;
    private $loader;
    private $registry;

    public function __construct(
        EntityManagerInterface $entityManager,
        ManagerRegistry $registry
    ) {
        $this->entityManager = $entityManager;
        $this->registry = $registry;
    }

    public function loadFixtures(array $classNames) : void
    {
        $this->loader = new Loader();

        foreach ($classNames as $className) {
            $this->loader->addFixture(new $className());
        }

        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute($this->loader->getFixtures());
    }

    public function getFixture(string $className) : Fixture
    {
        return $this->loader->getFixture($className);
    }

    private function getPurger() : ORMPurger
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        return $purger;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function cleanDatabase() : void
    {
        $connection = $this->entityManager->getConnection();

        $mysql = ('ORM' === $this->registry->getName()
            && $connection->getDatabasePlatform() instanceof MySqlPlatform);
        if ($mysql) {
            $connection->executeQuery('SET FOREIGN_KEY_CHECKS=0');
        }
        $this->getPurger()->purge();
        if ($mysql) {
            $connection->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}