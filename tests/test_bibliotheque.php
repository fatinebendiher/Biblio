<?php
$bib = new Bibliotheque();
$bl1 = new Livre('9782100545261', 'Algorithmique', 'Cormen');
$bl2 = new Livre('2070368228', 'Le Petit Prince', 'Saint-Exupéry');

verifier($bib->compter() === 0, 'Une bibliothèque neuve est vide');

$bib->ajouter($bl1);
$bib->ajouter($bl2);
verifier($bib->compter() === 2, 'Deux livres après deux ajouts');
verifier($bib->trouver('2070368228') === $bl2, 'trouver retourne le bon livre');
verifier($bib->trouver('0000000000') === null, 'trouver retourne null si absent');
verifier(count($bib->tous()) === 2, 'tous retourne 2 livres');

$doublon = false;
try { $bib->ajouter($bl1); } catch (Exception $e) { $doublon = true; }
verifier($doublon, 'ISBN en double refusé');

verifier(count($bib->rechercher('PETIT')) === 1, 'Recherche insensible à la casse (titre)');
verifier(count($bib->rechercher('cormen')) === 1, 'Recherche par auteur');
verifier(count($bib->rechercher('zzz')) === 0, 'Recherche sans résultat');