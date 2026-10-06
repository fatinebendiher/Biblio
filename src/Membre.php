<?php
class Membre
{
    private int $id;
    private string $nom;
    private array $emprunts = [];

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

        public function emprunter(Livre $livre): void
    {
        if (count($this->emprunts) >= 3) {
            throw new Exception("Limite de 3 livres atteinte");
        }
        $livre->emprunter();
        $this->emprunts[] = $livre;
    }

        public function rendre(Livre $livre): void
    {
        $index = array_search($livre, $this->emprunts, true);
        if ($index === false) {
            throw new Exception("Ce livre n'est pas emprunté par ce membre");
        }
        $livre->rendre();
        array_splice($this->emprunts, $index, 1);
    }

    public function getEmprunts(): array
    {
        return $this->emprunts;
    }
}