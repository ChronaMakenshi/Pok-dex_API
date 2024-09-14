<?php

namespace App\Controller\API;

use App\Entity\Evolution;
use App\Entity\Pokemon;
use App\Repository\EvolutionRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PokemonRepository;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\SerializerInterface;

class PokemonController extends AbstractController
{
    #[Route('api/pokemons', name: 'app_pokemon', methods: ['GET'])]
    public function index(PokemonRepository $pokemonRepository, EvolutionRepository $evolutionRepository): JsonResponse
    {
        $pokemons = $pokemonRepository->findAll();
        $evolutions = $evolutionRepository->findAll();

        foreach ($pokemons as $pokemon) {
            $evolutionData = [];
            foreach ($pokemon->getEvolutions() as $evolution) {
                $evolutionData[] = $evolution->getSpecies();
                $evolutionData[] = $evolution->getEvolutionDetails();
            }

            $data[] = [
                'id' => $pokemon->getId(),
                'nom' => $pokemon->getNom(),
                'genre' => $pokemon->getGenre(),
                'evolutions' => $evolutionData,
                'description' => $pokemon->getDescription(),
                'taille' => $pokemon->getTaille(),
                'poid' => $pokemon->getPoids(),
                'type' => $pokemon->getTypes(),
                'talent' => $pokemon->getTalent(),
                'talent caché' => $pokemon->getTalentCache(),
                'objet' => $pokemon->getObjetsTenus(),
                'statistique' => $pokemon->getStatistiques(),
                'apparait dans les versions' => $pokemon->getApparaitDansVersions(),
            ];
        }

        return $this->json($data, 200);
    }

    #[Route('api/pokemons/{id}', name: 'app_pokemon_show', methods: ['GET'])]
    public function show(int $id, PokemonRepository $pokemonRepository, EvolutionRepository $evolutionRepository): JsonResponse
    {
        $pokemon = $pokemonRepository->find($id);
        $evolutions = $evolutionRepository->findAll();

        if (!$pokemon) {
            return $this->json(['error' => 'Pokémon not found'], 404);
        }

        $evolutionData = [];
        foreach ($pokemon->getEvolutions() as $evolution) {
            $evolutionData[] = $evolution->getSpecies();
            $evolutionData[] = $evolution->getEvolutionDetails();
        }

        $data = [
            'id' => $pokemon->getId(),
            'nom' => $pokemon->getNom(),
            'genre' => $pokemon->getGenre(),
            'evolutions' => $evolutionData,
            'description' => $pokemon->getDescription(),
            'taille' => $pokemon->getTaille(),
            'poid' => $pokemon->getPoids(),
            'type' => $pokemon->getTypes(),
            'talent' => $pokemon->getTalent(),
            'talent caché' => $pokemon->getTalentCache(),
            'objet' => $pokemon->getObjetsTenus(),
            'statistique' => $pokemon->getStatistiques(),
            'apparait dans les versions' => $pokemon->getApparaitDansVersions(),
        ];

        return $this->json($data, 200);
    }

}
