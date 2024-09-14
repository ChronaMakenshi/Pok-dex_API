# Pokédex API

Cette API Pokémon vous permet d'accéder à une base de données détaillée des Pokémon, avec des informations telles que leurs types, talents, évolutions, statistiques, et plus encore.

## Fonctionnalités

- **Récupération de la liste des Pokémon** avec leurs caractéristiques.
- **Informations sur les évolutions** de chaque Pokémon.
- **Accès aux talents, statistiques, objets tenus** et apparitions dans les différentes versions du jeu.

## Endpoints

### GET `/api/pokemons`

Ce point de terminaison retourne une liste complète des Pokémon, ainsi que toutes les informations disponibles pour chaque Pokémon.

#### Exemple de réponse JSON

```json
[
  {
    "id": 1,
    "nom": "Bulbizarre",
    "genre": "Mâle et Femelle",
    "evolutions": [
      "Herbizarre",
      [
        {
          "min_level": 16
        }
      ],
      "Florizarre",
      [
        {
          "min_level": 32
        }
      ]
    ],
    "description": "Au matin de sa vie, la graine sur\nson dos lui fournit les éléments\ndont il a besoin pour grandir.",
    "taille": "0.7 m",
    "poid": "6.9 kg",
    "type": [
      "Grass",
      "Poison"
    ],
    "talent": [
      "Engrais"
    ],
    "talent caché": [
      "Chlorophylle"
    ],
    "objet": [],
    "statistique": {
      "PV": 45,
      "Attaque": 49,
      "Défense": 49,
      "Attaque Spéciale": 65,
      "Défense Spéciale": 65,
      "Vitesse": 45
    },
    "apparait dans les versions": [
      "Red",
      "Blue",
      "Yellow",
      "Gold",
      "Silver",
      "Crystal",
      "Ruby",
      "Sapphire",
      "Emerald",
      "Firered",
      "Leafgreen",
      "Diamond",
      "Pearl",
      "Platinum",
      "Heartgold",
      "Soulsilver",
      "Black",
      "White",
      "Black-2",
      "White-2",
      "X",
      "Y",
      "Omega Ruby",
      "Alpha Sapphire",
      "Sun",
      "Moon",
      "Ultra Sun",
      "Ultra Moon",
      "Let's Go Pikachu",
      "Let's Go Eevee",
      "Sword",
      "Shield",
      "Brilliant Diamond",
      "Shining Pearl",
      "Legends: Arceus",
      "Scarlet",
      "Violet"
    ]
  }
]
```
Installation
Clonez ce dépôt :

```bash
git clone https://github.com/votre-utilisateur/pokemon-api.git

```
Installez les dépendances :

```bash
composer install
```

Configurez votre base de données dans le fichier .env.

Exécutez les migrations pour générer les tables nécessaires :

```bash
php bin/console doctrine:migrations:migrate
```
Chargez les données Pokémon :

```bash
php bin/console app:import-pokemon-data
```
## Usage

Lancez le serveur de développement Symfony :

```bash
symfony serve
```
L'API sera accessible via http://localhost:8000/api/pokemons.

## Technologies
Symfony (PHP)
Doctrine ORM
JSON



