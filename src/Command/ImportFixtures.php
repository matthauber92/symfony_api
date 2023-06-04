<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\User;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:import:fixtures')]
class ImportFixtures extends Command
{
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Register the UuidType mapping
        if (!Type::hasType('uuid')) {
            Type::addType('uuid', UuidType::class);
        }

        $file = 'fixtures/user.yaml';
        // Read the YAML file
        $data = Yaml::parseFile($file);

        // Get the object manager for your entity
        $objectManager = $this->em->getManagerForClass(User::class);

        // Extract the user data
        $userData = $data[User::class]['user'];

        // Create a new User entity
        $user = new User();
        $uuid =  Uuid::fromString($userData['id']);
        dump($uuid . 'TESTST');
        $user->setId($uuid);
        $user->setUsername($userData['username']);
        $user->setPassword($userData['password']);

        // Persist the entity
        $objectManager->persist($user);

        // Flush the changes to the database
        $objectManager->flush();

        $output->writeln('Data imported successfully.');

        return Command::SUCCESS;
    }
}