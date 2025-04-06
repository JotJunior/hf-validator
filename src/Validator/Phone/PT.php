<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator\Phone;

use Jot\HfValidator\Validator\AbstractPhoneValidator;
use Jot\HfValidator\Validator\CountryPhoneInterface;
use Jot\HfValidator\Validator\CountryPhonePatterns;

class PT extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::PT;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '91', // Vodafone
        '92', // TMN/MEO
        '93', // Optimus/NOS
        '96', // TMN/MEO

        // Códigos de área fixos
        '21', // Lisboa
        '22', // Porto
        '231', // Mealhada
        '232', // Viseu
        '233', // Figueira da Foz
        '234', // Aveiro
        '235', // Arganil
        '236', // Pombal
        '238', // Seia
        '239', // Coimbra
        '241', // Abrantes
        '242', // Ponte de Sôr
        '243', // Santarém
        '244', // Leiria
        '245', // Portalegre
        '249', // Torres Novas
        '251', // Valença
        '252', // Vila Nova de Famalicão
        '253', // Braga
        '254', // Peso da Régua
        '255', // Penafiel
        '256', // São João da Madeira
        '258', // Viana do Castelo
        '259', // Vila Real
        '261', // Torres Vedras
        '262', // Caldas da Rainha
        '263', // Vila Franca de Xira
        '265', // Setúbal
        '266', // Évora
        '268', // Estremoz
        '269', // Santiago do Cacém
        '271', // Guarda
        '272', // Castelo Branco
        '273', // Bragança
        '274', // Proença-a-Nova
        '275', // Covilhã
        '276', // Chaves
        '277', // Idanha-a-Nova
        '278', // Mirandela
        '279', // Moncorvo
        '281', // Tavira
        '282', // Portimão
        '283', // Odemira
        '284', // Beja
        '285', // Moura
        '286', // Castro Verde
        '289', // Faro
        '291', // Funchal (Madeira)
        '292', // Horta (Açores)
        '295', // Angra do Heroísmo (Açores)
        '296', // Ponta Delgada (Açores)

        // Serviços especiais
        '800', // Números gratuitos
        '808', // Números de custo compartilhado
        '707', // Números de custo compartilhado
    ];
}
