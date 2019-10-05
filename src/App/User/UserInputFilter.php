<?php
declare(strict_types=1);

namespace App\User;

use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;

class UserInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'nombre',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => ['min' => 1, 'max' => 50],
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'apellidos',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => ['min' => 1, 'max' => 50],
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'cedula',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => ['min' => 6, 'max' => 10],
                ],
                [
                    'name' => Regex::class, 
                    'options' => [
                        'pattern' => '/^[0-9]+$/',
                        'messages' => [
                            Regex::NOT_MATCH => 'Please put here only numbers.',
                        ],
                    ],
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'correo',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => EmailAddress::class,
                    'options' => [
                        'messages' => [
                            EmailAddress::INVALID_FORMAT => 'The input is not a valid email address.'
                        ]                        
                    ]
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'telefono',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => ['min' => 10, 'max' => 15],
                ],
                [
                    'name' => Regex::class,
                    'options' => [
                        'pattern' => '/^[0-9]+$/',
                        'messages' => [
                            Regex::NOT_MATCH => 'Please put here only numbers.',
                        ],
                    ],
                ]
            ]
        ]);
        
    }
}
