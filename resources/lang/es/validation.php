<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El correo no tiene un formato válido.',
    'max' => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'digits' => 'El campo :attribute debe tener :digits dígitos.',
    'unique' => 'El :attribute ya está registrado.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'regex' => 'El :attribute no tiene un formato válido.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],

    'attributes' => [
        'name' => 'nombre',
        'phone' => 'teléfono',
        'email' => 'correo',
        'rfc' => 'RFC',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña',
        'notes' => 'notas',
    ],
];
