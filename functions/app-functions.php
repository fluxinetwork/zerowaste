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

	/*require_once( WP_CONTENT_DIR . '/app/httpclient/autoload.php' );

	use \HapiClient\Http;
	use \HapiClient\Hal;*/


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

				// url api Slim
				$api_base_url = "https://api-sandbox.slimpay.net";
				// montant transaction / abo
				$montant = 100;
				// ref Transaction
				$subscriber_ref = bin2hex(random_bytes(35));
				// ref First Debi
				$reference_fd = bin2hex(random_bytes(35));
				$label_fd = "Premier don à Zero Waste France";
				// ref Direct Debi
				$reference_dd = bin2hex(random_bytes(35));
				$label_dd = "Don récurrent à Zero Waste France";
				// tok Slim
				$access_token = '';

				wp_update_post(
					array(
						'ID' => $post_id,
						'post_title' => $post_title
					)
				);


				// get access token
				$args_get_tok = array(
				    'headers' => array(
				        'Authorization' => 'Basic ' . base64_encode( API_KEY . ':' . SECR_KEY ),
						'Accept' => 'application/json',
						'Content-Type' => 'application/x-www-form-urlencoded',
				    ),
				    'body' => array(
				    	'grant_type' => 'client_credentials',
				    	'scope' => 'api'
				    ),
				    'httpversion' => '1.1'
				);
				$response_remote = wp_remote_post( $api_base_url.'/oauth/token', $args_get_tok );

				if ( !is_array( $response_remote ) ) {
					// Wrong value return
				    $response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";
				} else {
				    // Find if response exist
					if( isset( $response_remote['response'] ) || array_key_exists('response',$response_remote) ):
						// If status HTTP is 200
						if( $response_remote['response']['code'] == 200 ):
							// Token granted
							//echo "Code 200 - Ok";

							$json_response = json_decode($response_remote['body']);
							$access_token = $json_response->access_token;
							//$token_type = $json_response->token_type;
							//$expires_in = $json_response->expires_in;
							//$scope = $json_response->scope;

							// get links
							$args_entrypoint = array(
							    'headers' => array(
							        'Authorization' => 'Bearer ' . $access_token,
									'Accept' => 'application/hal+json',
									'Profile' => $api_base_url.'/alps/v1/apps'
							    ),
				    			'httpversion' => '1.1'
							);
							$response_entrypoint = wp_remote_get(  $api_base_url, $args_entrypoint );

							if ( !is_array( $response_entrypoint ) ):
								// Wrong value return
							   $response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";
							else:
								// Find if response exist
								if( isset( $response_entrypoint['response'] ) || array_key_exists('response',$response_entrypoint) ):
									// If status HTTP is 200
									if( $response_entrypoint['response']['code'] == 200 ):


											/*echo '<pre>';
											print_r( $response_entrypoint );
											//print_r( $response_entrypoint['body'] );
											echo '</pre>';*/

										$body_req_recur_deb = array(
										    'started' => true,
										    'creditor' => array(
										        'reference' => CREDITOR_REF
										    ),
										    'subscriber' => array(
										        'reference' => 'subscriber01'
										    ),
										    'items' => array(
										        array(
										            'type' => 'signMandate',
										            'autoGenReference' => true,
										            'mandate' => array(
										                'signatory' => array(
										                    'billingAddress' => array(
										                        'street1' => '27 rue des fleurs',
										                        'street2' => 'Bat 2',
										                        'city' => 'Paris',
										                        'postalCode' => '75008',
										                        'country' => 'FR'
										                    ),
										                    'honorificPrefix' => 'Mr',
										                    'familyName' => 'Doe',
										                    'givenName' => 'John',
										                    'email' => 'change.me@slimpay.com',
										                    'telephone' => '+33612345678'
										                ),
										                'standard' => 'SEPA',
										                //'paymentScheme' => 'SEPA.DIRECT_DEBIT.CORE'
										            )
										        ),
										        array(
										            'type' => 'recurrentDirectDebit',
										            'recurrentDirectDebit' => array(
										                'reference' => $reference_dd,
										                'amount' => $montant,
										                'currency' => 'EUR',
										                'label' => $label_dd,
										                'frequency' => 'monthly',
										                'maxSddNumber' => 5,
										                'activated' => true,
										                'dateFrom' => '2018-11-04T13:11:52.900+0000'
										            )
										        )
										    )
										);


										// Set recurrent direct debits
									    $args_recur_deb = array(
										    'headers' => array(
										        'Authorization' => 'Bearer ' . $access_token,
												'Accept' => 'application/hal+json',
												'Content-Type' => 'application/json',
												'Profile' => $api_base_url.'/alps/v1/apps'
										    ),
										    'body' => json_encode($body_req_recur_deb),
				    						'httpversion' => '1.1'
										);
										$response_recur_deb = wp_remote_post(  $api_base_url.'/orders', $args_recur_deb );

										if ( !is_array( $response_recur_deb ) ):
											// Wrong value return
										   $response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";
										else:

											if( isset( $response_recur_deb['response'] ) || array_key_exists('response',$response_recur_deb) ):
												// If status HTTP is 201 == created
												if( $response_recur_deb['response']['code'] == 201 ):

													// Rec. Debit ok - go sign mandate
													// Decode response
													$a_recur_deb_jsondecod = json_decode($response_recur_deb['body'],true);
													$user_approval_base_url = 'https://api.slimpay.net/alps#extended-user-approval';

													// Search user-approuval url
													if ( in_array($user_approval_base_url,$a_recur_deb_jsondecod) ):

														$url_extended_user_approval = $api_base_url.'/creditors/'.CREDITOR_REF.'/orders/'.$a_recur_deb_jsondecod['reference'].'/extended-user-approval';
														$body_req_get_iframe = array('mode' => 'iframeembedded');

														// get iframe
														$args_get_iframe = array(
															'headers' => array(
														        'Authorization' => 'Bearer ' . $access_token,
																'Accept' => 'application/hal+json',
																'Content-Type' => 'application/json',
																'Profile' => $api_base_url.'/alps/v1/apps'
														    ),
														    'body' => $body_req_get_iframe,
				    										'httpversion' => '1.1'
														);
														$response_get_iframe = wp_remote_get( $url_extended_user_approval, $args_get_iframe );

														$a_get_iframe_jsondecod = json_decode($response_get_iframe['body'],true);
														//$iframe_content = base64_decode($a_get_iframe_jsondecod['content']);
														$iframe_content = $a_get_iframe_jsondecod['content'];

														// Redirect
        												//wp_redirect( get_permalink(RETURN_AFTER_URL).'?message='.$response.'&idp=' . $post_id . '&st=' . $security_token ); exit;

														wp_redirect( get_permalink(RETURN_AFTER_URL).'?message='.$iframe_content.'&idp=' . $post_id ); exit;

														/*echo '<pre>';
														print_r( $response_get_iframe );
														echo '</pre>';*/

														
													else :
														$response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";
													endif;


												else :

													/// Other HTTP codes
													/*/********************************
														* 	301 et 302 : redirection, respectivement permanente et temporaire ;
													   *	401 : utilisateur non authentifié ;
													  *		403 : accès refusé ;
													 *  	404 : page non trouvée ;
													*  		500 et 503 : erreur serveur.
												    */
													$response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";

												endif;
											endif;

											/*echo '<pre>';
											print_r( $response_recur_deb );
											//print_r( $response_recur_deb['body'] );
											echo '</pre>';
											exit;*/


										endif;/**/

									else :

										/// Other HTTP codes
										/*/********************************
											* 	301 et 302 : redirection, respectivement permanente et temporaire ;
										   *	401 : utilisateur non authentifié ;
										  *		403 : accès refusé ;
										 *  	404 : page non trouvée ;
										*  		500 et 503 : erreur serveur.
									    */
										$response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";

									endif;
								endif;



								/*echo '<pre>';
								print_r( $response_entrypoint );
								//print_r( $response_entrypoint['body'] );
								echo '</pre>';
								exit;*/

							endif;

						/*echo '<pre>';
						print_r( $response_remote['body'] );
						print_r( $response_remote['response'] );
						echo('--');
						print_r($access_token);
						echo '</pre>';
					   	exit;*/

						else:
							/// Other HTTP codes
							/*/********************************
								* 	301 et 302 : redirection, respectivement permanente et temporaire ;
							   *	401 : utilisateur non authentifié ;
							  *		403 : accès refusé ;
							 *  	404 : page non trouvée ;
							*  		500 et 503 : erreur serveur.
						    */
							$response = "Il y a une erreur. Veuillez essayez à nouveau ou nous contacter.";
						endif;
					endif;





				}


			else:

				$response = 'error';

			endif;

		else:

			$response = 'error';

		endif;

		// Redirect
        //wp_redirect( get_permalink(RETURN_AFTER_URL).'?message='.$response.'&idp=' . $post_id . '&st=' . $security_token ); exit;


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

/**
 * Search value in a multidimensional array
 *
 * @param   N/A
 *
 * @return	string - The generic mail footer
 */

function in_multiarray($elem, $array){
    while (current($array) !== false) {
        if (current($array) == $elem) {
            return true;
        } elseif (is_array(current($array))) {
            if (in_multiarray($elem, current($array))) {
                return true;
            }
        }
        next($array);
    }
    return false;
}

