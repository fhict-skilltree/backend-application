<?php

// These attributes mimic those of Azure AD.
$test_user_base = [
    'http://schemas.microsoft.com/identity/claims/tenantid' => 'ab4f07dc-b661-48a3-a173-d0103d6981b2',
    'http://schemas.microsoft.com/identity/claims/objectidentifier' => '',
    'http://schemas.microsoft.com/identity/claims/displayname' => '',
    'http://schemas.microsoft.com/ws/2008/06/identity/claims/groups' => [],
    'http://schemas.microsoft.com/identity/claims/identityprovider' => 'https://sts.windows.net/da2a1472-abd3-47c9-95a4-4a0068312122/',
    'http://schemas.microsoft.com/claims/authnmethodsreferences' => [
        'http://schemas.microsoft.com/ws/2008/06/identity/authenticationmethod/password',
        'http://schemas.microsoft.com/claims/multipleauthn',
    ],
    'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress' => '',
    'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname' => '',
    'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname' => '',
    'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name' => ''
];

$config = [
    'admin' => [
        'core:AdminPassword',
    ],
    'example-userpass' => [
        'exampleauth:UserPass',
        'femke:password' => array_merge($test_user_base, [
            'http://schemas.microsoft.com/identity/claims/objectidentifier' => 'f2d75402-e1ae-40fe-8cc9-98ca1ab9cd5e',
            'http://schemas.microsoft.com/identity/claims/displayname' => 'Femke Student',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress' => '101@student.fontys.nl',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname' => 'Femke',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname' => 'Student',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name' => '101@student.fontys.nl'
        ]),
        'piet:password' => array_merge($test_user_base, [
            'http://schemas.microsoft.com/identity/claims/objectidentifier' => 'f2a94916-2fcb-4b68-9eb1-5436309006a3',
            'http://schemas.microsoft.com/identity/claims/displayname' => 'Piet Student',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress' => '102@student.fontys.nl',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname' => 'Piet',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname' => 'Student',
            'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name' => '102@student.fontys.nl'
        ]),
    ],
];
