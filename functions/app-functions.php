<?php

/* | CUSTOM FUNCTIONS - V1.0 - 28/07/17 |
-------------------------------------------------------
   | fluxi_acf_save_post()
   | get_footer_mail()
   | 
*/

/**
 * Pre-save Post
 *
 * @param   Post ID
 *
 * @return	N/A
 */

function fluxi_acf_save_post( $post_id ) {

	global $post;
	
	require_once( WP_CONTENT_DIR . '/app/httpclient/autoload.php' );

	use \HapiClient\Http;
	use \HapiClient\Hal;


	// Adding RDV (front process)
    if ( isset($_POST['is_adding_don']) && !empty($_POST['is_adding_don']) ):
		if ( $_POST['is_adding_don'] === "yes" ) :
			// Inser the title from
			if(fluxi_post_exists($post_id)):
				
				$nom_contact = wp_strip_all_tags(get_field('nom', $post_id));
				$prenom_contact = wp_strip_all_tags(get_field('prenom', $post_id));
				$email_contact = wp_strip_all_tags(get_field('mail', $post_id));

				$post_title = wp_strip_all_tags($nom_contact.' '.$prenom_contact.' - '.bin2hex(random_bytes(4)));

				$post_url = get_permalink($post_id);
				$home_url = home_url();	

				/*wp_update_post(
					array(
						'ID' => $post_id,
						'post_title' => $post_title
					)
				);*/

		    	// Création token de sécurisation
		    	$security_token = bin2hex(random_bytes(35));
				/*if ( ! add_post_meta( $post_id, 'security_token', $security_token, true ) ) :
				   update_post_meta( $post_id, 'security_token', $security_token );
				endif;*/

				// The HAPI Client
				/*$hapiClient = new Http\HapiClient(
				    'https://api-sandbox.slimpay.net',
				    '/',
				    'https://api.slimpay.net/alps/v1',
				    new Http\Auth\Oauth2BasicAuthentication(
				        '/oauth/token',
				        API_KEY,
				        SECR_KEY
				    )
				);

				$relNs = 'https://api.slimpay.net/alps#';

				$rel = new Hal\CustomRel($relNs . 'create-orders');
				$follow = new Http\Follow($rel, 'POST', null, new Http\JsonBody(					
				[
				    'started' => true,
				    'locale' => null,
				    'paymentScheme' => 'SEPA.DIRECT_DEBIT.CORE',
				    'creditor' => [
				        'reference' => CREDITOR_REF
				    ],
				    'subscriber' => [
				        'reference' => $security_token
				    ],
				    'items' => [
				        [
				            'type' => 'signMandate',
				            'action' => 'sign',
				            'mandate' => [
				                'reference' => null,
				                'signatory' => [
				                    'honorificPrefix' => 'Mr',
				                    'givenName' => 'John',
				                    'familyName' => 'Doe',
				                    'email' => 'change.me@slimpay.com',
				                    'telephone' => '+33612345678',
				                    'companyName' => null,
				                    'organizationName' => null,
				                    'billingAddress' => [
				                        'street1' => '27 rue des fleurs',
				                        'street2' => 'Bat 2',
				                        'city' => 'Paris',
				                        'postalCode' => '75008',
				                        'country' => 'FR'
				                    ]
				                ]
				            ]
				        ]
				    ]
				]
				));
				$order = $hapiClient->sendFollow($follow);
				$orderReference = $order->getState()['reference'];*/



				



				$response = 'success';

			else:

				$response = 'error';

			endif;

		else:

			$response = 'error';

		endif;

		// Redirect
        wp_redirect( get_permalink(RETURN_AFTER_URL).'?message='.$response.'&idp=' . $post_id . '&st=' . $security_token ); exit;


    endif;

}
add_action('acf/save_post', 'fluxi_acf_save_post', 20);


/**
 * Get email footer
 *
 * @param   N/A
 *
 * @return	string - The generic mail footer
 */

function get_footer_mail(){
	$footer_mail = do_shortcode(get_field('pied_de_mail','option'));

	 // return footer mail
    return $footer_mail;
}

