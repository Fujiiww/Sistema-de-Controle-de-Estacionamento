<?php 

namespace App\Domain\Validator;

class PlateValidator
{
    
    public static function isValid(string $plate): bool
    {
        $plate = strtoupper(trim($plate));
        
        return preg_match('/^[A-Z]{3}-?[0-9]{4}$|^[A-Z]{3}[0-9][A-Z][0-9]{2}$/i', $plate) === 1;
    }
}