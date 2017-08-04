<?php /* Template Name: Test paiement inline */ ?>
<?php
// Instructions: https://github.com/SlimPay/hapiclient-php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/app/httpclient/autoload.php'); 

//require_once 'httpclient/autoload.php';

use \HapiClient\Http;
use \HapiClient\Hal;

// The HAPI Client
$hapiClient = new Http\HapiClient(
    'https://api-sandbox.slimpay.net',
    '/',
    'https://api.slimpay.net/alps/v1',
    new Http\Auth\Oauth2BasicAuthentication(
        '/oauth/token',
        'hbil7wmezce4',
        't8lWqtLCz4hdre~lSNH2pIb3V1r8DAQhUDvX'
    )
);

// The Relations Namespace
$relNs = 'https://api.slimpay.net/alps#';

// Follow create-orders
$rel = new Hal\CustomRel($relNs . 'create-orders');
$follow = new Http\Follow($rel, 'POST', null, new Http\JsonBody(
[
    'started' => true,
    'creditor' => [
        'reference' => 'hbil7wmezce4'
    ],
    'subscriber' => [
        'reference' => 'testphpclient01'
    ],
    'items' => [
        [
            'type' => 'signMandate',
            'autoGenReference' => true,
            'mandate' => [
                'signatory' => [
                    'billingAddress' => [
                        'street1' => '27 rue des fleurs',
                        'street2' => 'Bat 2',
                        'city' => 'Paris',
                        'postalCode' => '75008',
                        'country' => 'FR'
                    ],
                    'honorificPrefix' => 'Mr',
                    'familyName' => 'Doe',
                    'givenName' => 'John',
                    'email' => 'change.me@slimpay.com',
                    'telephone' => '+33612345678'
                ],
                'standard' => 'SEPA'
            ]
        ]
    ]
]
));
$res = $hapiClient->sendFollow($follow);
$url = $res->getLink('https://api.slimpay.net/alps#user-approval')->getHref();
header('Location:' . $url);
exit;
?>



<?php get_header(); ?>

	<header class="l-col">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>

<?php get_footer(); ?>

