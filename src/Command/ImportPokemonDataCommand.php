<?php

namespace App\Command;

use App\Entity\Pokemon;
use App\Entity\Evolution;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'app:import-pokemon-data',
    description: 'Import Pokemon data from JSON file into the database.'
)]
class ImportPokemonDataCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::OPTIONAL, 'The JSON file to import', 'public/data/pokemon_all.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');

        if (!file_exists($file) || !is_readable($file)) {
            $output->writeln('<error>File does not exist or is not readable.</error>');
            return Command::FAILURE;
        }

        $jsonData = file_get_contents($file);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $output->writeln('<error>Invalid JSON data: ' . json_last_error_msg() . '</error>');
            return Command::FAILURE;
        }

        $batchSize = 20;
        $i = 0;

        foreach ($data as $pokemonData) {
            $pokemon = new Pokemon();
            $pokemon->setNom($pokemonData['nom'] ?? '');
            $pokemon->setGenre($pokemonData['genre'] ?? '');
            $pokemon->setDescription($pokemonData['description'] ?? '');
            $pokemon->setTaille($pokemonData['taille'] ?? '');
            $pokemon->setPoids($pokemonData['poids'] ?? '');
            $pokemon->setTypes($pokemonData['types'] ?? []);
            $pokemon->setTalent($pokemonData['talent'] ?? []);
            $pokemon->setTalentCache(
                isset($pokemonData['talent_cache'])
                    ? (is_array($pokemonData['talent_cache']) ? $pokemonData['talent_cache'] : [$pokemonData['talent_cache']])
                    : []
            );
            $pokemon->setObjetsTenus($pokemonData['objets_tenus'] ?? []);
            $pokemon->setStatistiques($pokemonData['statistiques'] ?? []);
            $pokemon->setApparaitDansVersions($pokemonData['apparait_dans_versions'] ?? []);

            $this->entityManager->persist($pokemon);

            if (isset($pokemonData['evolutions']) && is_array($pokemonData['evolutions'])) {
                foreach ($pokemonData['evolutions'] as $evolutionData) {
                    $evolution = new Evolution();
                    $evolution->setSpecies($evolutionData['species'] ?? '');
                    $evolution->setEvolutionDetails($evolutionData['evolution_details'] ?? []);
                    $evolution->setPokemon($pokemon);

                    $this->entityManager->persist($evolution);
                }
            }

            if (($i % $batchSize) === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }

            $i++;
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        $output->writeln('<info>Pokemon data imported successfully!</info>');

        return Command::SUCCESS;
    }
}


