<?php

function makeMessages()
{
    $messages = [
        'name.required' => 'El campo nombre es requerido',
        'name.min' => 'El campo nombre necesita un minimo de 3 caracteres',
        'email.required' => 'El campo correo electronico es requerido',
        'password.required' => 'El campo contraseña es requerido',
        'stock.required' => 'El campo Stock es requerido',
        'price.required' => 'El campo precio es requerido'

    ];

    return $messages;
}
