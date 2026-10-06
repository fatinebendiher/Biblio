<?php
$membre = new Membre(1, 'Aya');
verifier($membre->getId() === 1, 'getId retourne 1');
verifier($membre->getNom() === 'Aya', 'getNom retourne Aya');
verifier($membre->getEmprunts() === [], 'Aucun emprunt au départ');

$lm1 = new Livre('9782100545261', 'Algo', 'Cormen');
$lm2 = new Livre('9780132350884', 'Clean Code', 'Martin');
$lm3 = new Livre('9780201633610', 'Design Patterns', 'Gamma');
$lm4 = new Livre('9780596517748', 'JavaScript', 'Crockford');

$membre->emprunter($lm1);
verifier(count($membre->getEmprunts()) === 1, 'Un emprunt enregistré');
verifier(!$lm1->estDisponible(), 'Livre indisponible après emprunt');

$membre->emprunter($lm2);
$membre->emprunter($lm3);

$exceptionLevee = false;
try {
    $membre->emprunter($lm4);
} catch (Exception $e) {
    $exceptionLevee = true;
}
verifier($exceptionLevee, 'Le 4e emprunt lève une exception');
verifier($lm4->estDisponible(), 'Le 4e livre reste disponible');

$membre->rendre($lm1);
verifier($lm1->estDisponible(), 'Livre disponible après rendu');
verifier(count($membre->getEmprunts()) === 2, 'Il reste 2 emprunts');