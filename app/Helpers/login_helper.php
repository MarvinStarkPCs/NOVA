<?php

if (!function_exists('generate_login')) {
    function generate_login($name, $last_name) {
        // Tomar solo el primer nombre
        $firstName = explode(' ', trim($name))[0];

        // Tomar solo el primer apellido
        $firstLastName = explode(' ', trim($last_name))[0];

        // Normalizar (todo en minúsculas y sin espacios)
        $firstName = strtolower(preg_replace('/\s+/', '', $firstName));
        $firstLastName = strtolower(preg_replace('/\s+/', '', $firstLastName));

        // Generar número aleatorio
        $random = rand(100, 999);

        // Retornar login sin puntos
        return $firstName . $firstLastName . $random;
    }
}
