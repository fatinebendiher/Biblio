<?php
class Bibliotheque
{
    /** @var Livre[] livres indexés par ISBN */
    private array $livres = [];
       /** Ajoute un livre ; lève une Exception si l'ISBN existe déjà. */
    public function ajouter(Livre $l): void
    {
        if (isset($this->livres[$l->getIsbn()])) {
            throw new Exception("ISBN déjà présent : " . $l->getIsbn());
        }
        $this->livres[$l->getIsbn()] = $l;
    }
        public function trouver(string $isbn): ?Livre
    {
        return $this->livres[$isbn] ?? null;
    }

    public function tous(): array
    {
        return array_values($this->livres);
    }

    public function compter(): int
    {
        return count($this->livres);
    }
        public function rechercher(string $mot): array
    {
        $mot = mb_strtolower($mot);
        return array_values(array_filter(
            $this->livres,
            fn(Livre $l) =>
                str_contains(mb_strtolower($l->getTitre()), $mot)
                || str_contains(mb_strtolower($l->getAuteur()), $mot)
        ));
    }
}