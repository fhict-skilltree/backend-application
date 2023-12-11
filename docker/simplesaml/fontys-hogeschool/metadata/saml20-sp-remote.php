<?php

$metadata['https://talentpulse-backend.localhost/auth/methods/saml2-sp/metadata'] = [
    'entityid' => 'https://talentpulse-backend.localhost/auth/methods/saml2-sp/metadata',
    'contacts' => [
        [
            'contactType' => 'support',
        ],
    ],
    'metadata-set' => 'saml20-sp-remote',
    'AssertionConsumerService' => [
        [
            'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
            'Location' => 'https://talentpulse-backend.localhost/auth/methods/saml2/a5c5d904-ed29-4462-ab6b-e73cb3270967/acs/',
            'index' => 0,
            'isDefault' => true,
        ],
        [
            'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact',
            'Location' => 'https://talentpulse-backend.localhost/auth/methods/saml2/a5c5d904-ed29-4462-ab6b-e73cb3270967/acs/',
            'index' => 1,
        ],
        [
            'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
            'Location' => 'https://talentpulse-backend.localhost/auth/methods/saml2/a5c5d904-ed29-4462-ab6b-e73cb3270967/sls/',
            'index' => 2,
        ],
    ],
    'SingleLogoutService' => [
        [
            'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
            'Location' => 'https://talentpulse-backend.localhost/auth/methods/saml2/a5c5d904-ed29-4462-ab6b-e73cb3270967/sls/',
        ],
        [
            'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
            'Location' => 'https://talentpulse-backend.localhost/auth/methods/saml2/a5c5d904-ed29-4462-ab6b-e73cb3270967/acs/',
        ],
    ],
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'keys' => [
        [
            'encryption' => true,
            'signing' => false,
            'type' => 'X509Certificate',
            'X509Certificate' => 'MIIFazCCA1OgAwIBAgIUUTeSrL+SD60GZ8JimJQ/CFYvIRkwDQYJKoZIhvcNAQELBQAwRTELMAkGA1UEBhMCTkwxEzARBgNVBAgMClNvbWUtU3RhdGUxITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDAeFw0yMzEwMDYxNDI2MzdaFw0zNzA2MTQxNDI2MzdaMEUxCzAJBgNVBAYTAk5MMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQwggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQCaF//4AUuvlxqtx7koHvR4WIZQLpG6qcXKJfIdWwxlzxIwX2mOD2uYUQiwlYJFRfDA+RTTzKArZD8fzhiqLoXxMbf/5CtmugWywBZ8ZkvkCYelq6fuyQlMdIXs7PlYgUy+IBo+ZW3fLr2GABMYzm9QX+ZWEhA5yeUvH4toIGpjok42kUT1fdfDawPheYcC+sdjNpQuQ00Khd7/2IEvmKeHTBBgtz5r8USATDZMt6K9VkfXGa9pxssI8Hqzfg3eqGAFk7TIIlERgdibgj+IytIksrEsEdIV0tCX+cVNTQ2RSgMQckhRcXZpZpV8Rw3O87PmEcIaClqcIe4elZm7W6jasZuOLh4xn+p1Kn/bpqirKexrM8EQpiRNSscADEOGZhazbCfA9IF3do+6WU1w/BnfRnPDtGaYBudVmhysu1Bi9KyWp9ASNeDXdLlZDdETUc+WYt4GT+h6USHTrBGeRazqD/QEWm7BhbteRNtydaKXDmg6Le04Gm/G6W7fCqAOIDsfq2//3p+gjJp5Bf/5mDDgtVi0+rAOQ27U+jX88h0d+2GOHobqOUTYVypp3o6u/L41yczu25Vl161Xjzf+sfYrP3BhqxlUl9FzyKL9Z/0hsb4OYgNwowlE46+YdZZalT9A9ywOU5LW42XFE8rSzn3cwIAVTuhsq8PfSOgL810bfQIDAQABo1MwUTAdBgNVHQ4EFgQUFpDN3fkR1JKGth99fDW1+WhnwskwHwYDVR0jBBgwFoAUFpDN3fkR1JKGth99fDW1+WhnwskwDwYDVR0TAQH/BAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAgEARJ7WtoK9S7sfBEJiwua9wO/WgPRtQOxoloYuHu4Ii0kMIxRBVVPv1uKz2JdtWIq5frYalC6w/FmYhAItMqz5uFpGUboLwFiz8Ip8kvK8f/1wO7P/Rz2RGS6y4vHP+IlC9A1ZAtHEWbRzyqq0nbWjngnnVJrFVAME298rZGiJTOxOjeKFYlfro/t41OAzPg20oVoUssjfz23inylBpKgJEptMYS1wCaRwXZquhNfTWoVKEfnmlzyW2aaO/WHt3POGbmpgej8G/AzAYmiPRDhln4uTNKyTZYOLf9J/OfDlp19pk+RKFJyCWgnSObxg2S7Hhau2MXzqyuw8SwZiHJzWsq/dSiwTBqZfkk8Wz9AhQCAEUli8mtBcBpFkyfYv6vZ49AHqaYIkUHKSLg3sbYaiGuVL1vkwGQ7WWrtDIxJSjUOKOxKlSHKxjkxB/Kr8FRn6FoTT6TXgfk1rrreeU40xxHTR9sozlRx8fK7PyycDhZYlCjIwkKjBr8pW/dP+uDcEvFLmRczhyeZdk7e/sVYQdCBVxCsl872OjsMSZFVzH+sL0puMnQI0oG15VY1hU2CKh1/DKzcqG/XRzQPIp83WvVQooAWGt7I6gLugExl+DyH+jngKX2zWt2cdP0UakLkXBtA2yZYzm1ITNrZD70VMOaKrv3ZJKGtsMG1pgvXDfbk=',
        ],
        [
            'encryption' => false,
            'signing' => true,
            'type' => 'X509Certificate',
            'X509Certificate' => 'MIIFazCCA1OgAwIBAgIUUTeSrL+SD60GZ8JimJQ/CFYvIRkwDQYJKoZIhvcNAQELBQAwRTELMAkGA1UEBhMCTkwxEzARBgNVBAgMClNvbWUtU3RhdGUxITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDAeFw0yMzEwMDYxNDI2MzdaFw0zNzA2MTQxNDI2MzdaMEUxCzAJBgNVBAYTAk5MMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQwggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQCaF//4AUuvlxqtx7koHvR4WIZQLpG6qcXKJfIdWwxlzxIwX2mOD2uYUQiwlYJFRfDA+RTTzKArZD8fzhiqLoXxMbf/5CtmugWywBZ8ZkvkCYelq6fuyQlMdIXs7PlYgUy+IBo+ZW3fLr2GABMYzm9QX+ZWEhA5yeUvH4toIGpjok42kUT1fdfDawPheYcC+sdjNpQuQ00Khd7/2IEvmKeHTBBgtz5r8USATDZMt6K9VkfXGa9pxssI8Hqzfg3eqGAFk7TIIlERgdibgj+IytIksrEsEdIV0tCX+cVNTQ2RSgMQckhRcXZpZpV8Rw3O87PmEcIaClqcIe4elZm7W6jasZuOLh4xn+p1Kn/bpqirKexrM8EQpiRNSscADEOGZhazbCfA9IF3do+6WU1w/BnfRnPDtGaYBudVmhysu1Bi9KyWp9ASNeDXdLlZDdETUc+WYt4GT+h6USHTrBGeRazqD/QEWm7BhbteRNtydaKXDmg6Le04Gm/G6W7fCqAOIDsfq2//3p+gjJp5Bf/5mDDgtVi0+rAOQ27U+jX88h0d+2GOHobqOUTYVypp3o6u/L41yczu25Vl161Xjzf+sfYrP3BhqxlUl9FzyKL9Z/0hsb4OYgNwowlE46+YdZZalT9A9ywOU5LW42XFE8rSzn3cwIAVTuhsq8PfSOgL810bfQIDAQABo1MwUTAdBgNVHQ4EFgQUFpDN3fkR1JKGth99fDW1+WhnwskwHwYDVR0jBBgwFoAUFpDN3fkR1JKGth99fDW1+WhnwskwDwYDVR0TAQH/BAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAgEARJ7WtoK9S7sfBEJiwua9wO/WgPRtQOxoloYuHu4Ii0kMIxRBVVPv1uKz2JdtWIq5frYalC6w/FmYhAItMqz5uFpGUboLwFiz8Ip8kvK8f/1wO7P/Rz2RGS6y4vHP+IlC9A1ZAtHEWbRzyqq0nbWjngnnVJrFVAME298rZGiJTOxOjeKFYlfro/t41OAzPg20oVoUssjfz23inylBpKgJEptMYS1wCaRwXZquhNfTWoVKEfnmlzyW2aaO/WHt3POGbmpgej8G/AzAYmiPRDhln4uTNKyTZYOLf9J/OfDlp19pk+RKFJyCWgnSObxg2S7Hhau2MXzqyuw8SwZiHJzWsq/dSiwTBqZfkk8Wz9AhQCAEUli8mtBcBpFkyfYv6vZ49AHqaYIkUHKSLg3sbYaiGuVL1vkwGQ7WWrtDIxJSjUOKOxKlSHKxjkxB/Kr8FRn6FoTT6TXgfk1rrreeU40xxHTR9sozlRx8fK7PyycDhZYlCjIwkKjBr8pW/dP+uDcEvFLmRczhyeZdk7e/sVYQdCBVxCsl872OjsMSZFVzH+sL0puMnQI0oG15VY1hU2CKh1/DKzcqG/XRzQPIp83WvVQooAWGt7I6gLugExl+DyH+jngKX2zWt2cdP0UakLkXBtA2yZYzm1ITNrZD70VMOaKrv3ZJKGtsMG1pgvXDfbk=',
        ],
    ],
    'saml20.sign.assertion' => true,
];
