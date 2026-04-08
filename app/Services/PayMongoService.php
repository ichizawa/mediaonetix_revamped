<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PayMongoService
{
    protected $client;
    protected $secretKey;
    protected $baseUrl;
    protected $verifySsl;
    protected $caBundle;

    public function __construct()
    {
        $this->secretKey = config('services.paymongo.secret');
        $this->baseUrl = config('services.paymongo.base_url');
        $this->verifySsl = filter_var(config('services.paymongo.verify_ssl', true), FILTER_VALIDATE_BOOL);
        $this->caBundle = config('services.paymongo.ca_bundle');

        $clientOptions = [];

        if ($this->verifySsl) {
            if (!empty($this->caBundle)) {
                $clientOptions['verify'] = $this->caBundle;
            }
        } else {
            $clientOptions['verify'] = false;
        }

        $this->client = new Client($clientOptions);
    }

    public function createPaymentIntent($amount, $description)
    {
        try {
            $url = $this->baseUrl . '/payment_intents';

            $headers = [
                'Authorization' => 'Basic ' . base64_encode($this->secretKey . ':'),
                'Content-Type' => 'application/json'
            ];

            $body = [
                'data' => [
                    'attributes' => [
                        'amount' => $amount * 100,
                        'payment_method_allowed' => ["gcash", "paymaya", "card", "dob"],
                        'currency' => 'PHP',
                        'payment_method_options' => [
                            'card' => [
                                "request_three_d_secure" => "any"
                            ],
                        ],
                        'capture_type' => "automatic",
                        'description' => $description
                    ]
                ]
            ];

            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $body
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createPaymentMethod($paymentMethodType, $cardDetails = null, $customerDetails = null)
    {
        try {
            $url = $this->baseUrl . '/payment_methods';

            $headers = [
                'Authorization' => 'Basic ' . base64_encode($this->secretKey . ':'),
                'Content-Type' => 'application/json'
            ];

            $attributes = [];

            if (str_starts_with($paymentMethodType, 'dob_')) {
                $bankCode = str_replace('dob_', '', $paymentMethodType); // Extracts 'bdo', 'landbank', 'metrobank'
                $attributes['type'] = 'dob';
                $attributes['details'] = [
                    'bank_code' => $bankCode
                ];
            } else {
                $attributes['type'] = $paymentMethodType;
            }

            if ($paymentMethodType === 'card' && $cardDetails !== null) {
                $attributes['details'] = [
                    'card_number' => preg_replace('/[^0-9]/', '', $cardDetails['card_number']),
                    'exp_month' => (int)$cardDetails['exp_month'],
                    'exp_year' => (int)$cardDetails['exp_year'],
                    'cvc' => (string)$cardDetails['cvc'],
                ];
            }

            if ($customerDetails !== null) {
                $attributes['billing'] = [
                    'name' => $customerDetails['name'],
                    'email' => $customerDetails['email'],
                    'phone' => $customerDetails['phone'],
                ];
            }

            $body = [
                'data' => [
                    'attributes' => $attributes
                ]
            ];

            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $body
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function attachPaymentMethod($paymentIntentId, $paymentMethodId, $paymentMethodType, $returnURL)
    {
        try {
            $url = $this->baseUrl . "/payment_intents/{$paymentIntentId}/attach";

            $headers = [
                'Authorization' => 'Basic ' . base64_encode($this->secretKey . ':'),
                'Content-Type' => 'application/json'
            ];

            $body = [];

            $isRedirectMethod = in_array($paymentMethodType, ["gcash", "paymaya", "card"]) || str_starts_with($paymentMethodType, 'dob_');
            if ($isRedirectMethod) {
                $body = [
                    'data' => [
                        'attributes' => [
                            'payment_method' => $paymentMethodId,
                            'return_url' => $returnURL
                        ]
                    ]
                ];
            } else {
                $body = [
                    'data' => [
                        'attributes' => [
                            'payment_method' => $paymentMethodId
                        ]
                    ]
                ];
            }

            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $body
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getPaymentIntent($paymentIntentId)
    {
        try {
            $url = $this->baseUrl . "/payment_intents/{$paymentIntentId}";

            $headers = [
                'Authorization' => 'Basic ' . base64_encode($this->secretKey . ':'),
                'Content-Type' => 'application/json'
            ];

            $response = $this->client->get($url, [
                'headers' => $headers
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}
