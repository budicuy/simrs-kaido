<?php

return [

    'title' => 'Login',

    'heading' => 'Masuk',

    'actions' => [

        'register' => [
            'before' => 'or',
            'label' => 'Daftar Akun',
        ],

        'request_password_reset' => [
            'label' => 'Lupa Password?',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Email',
        ],

        'password' => [
            'label' => 'Password',
        ],

        'remember' => [
            'label' => 'Ingat Saya',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Masuk',
            ],

        ],

    ],

    'messages' => [

        'failed' => 'Username atau Password Salah.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Terlalu banyak upaya login',
            'body' => 'Silahkan coba beberapa saat lagi.',
        ],

    ],

];
