<?php /* Template Name: Documentation Slimpay */ ?>


<?php get_header(); ?>

<div class="l-row">	

	<div class="l-col l-col--content">
		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post(); ?>
				<?php the_title( '<h1>', '</h1>' ); ?>		

				<?php the_content(); ?>

				<hr>

				<h1>Order</h1>

				<h2>Référence ou RUM :  Référence Unique du Mandat</h2>
				<p>Chaque mandat de prélèvement donné par un débiteur est identifié par une Référence Unique de Mandat ::: Text, 40 characters or less</p>

				<h2>sendUserApproval</h2>
				<p>This descriptor controls whether user approval link will be sent to subscriber's email when finishing order creation. Constraints: Boolean, Read-Write.</p>
				
				<h2>checkoutActor</h2>
				<p>The checkout actor indicates who creates order. The default value is end_user. Constraints: Text among end_user|third_party, Read-Write</p>


				<h3>Example: An order representation</h3>
				<p>
				{<br>
				    "checkoutActor": "end_user",<br>
				    "dateCreated": "2014-12-12T09:35:39.000+0000",<br>
				    "id": "a621cee0-d679-11e6-bd80-000000000001",<br>
				    "mandateReused": false,<br>
				    "paymentScheme": "SEPA.DIRECT_DEBIT.CORE",<br>
				    "reference": "1",<br>
				    "sendUserApproval": false,<br>
				    "started": true,<br>
				    "state": "closed.completed",<br>
				    "_links": {<br>
				        "https://api.slimpay.net/alps#get-mandate": {<br>
				            "href": "https://api-sandbox.slimpay.net/mandates/462942d2-7648-11e5-add6-f175896a8489"<br>
				        },<br>
				        "https://api.slimpay.net/alps#get-creditor": {<br>
				            "href": "https://api-sandbox.slimpay.net/creditors/democreditor"<br>
				        },<br>
				        "self": {<br>
				            "href": "https://api-sandbox.slimpay.net/orders/a621cee0-d679-11e6-bd80-000000000001"<br>
				        },<br>
				        "https://api.slimpay.net/alps#get-subscriber": {<br>
				            "href": "https://api-sandbox.slimpay.net/orders/a621cee0-d679-11e6-bd80-000000000001/subscriber"<br>
				        },<br>
				        "profile": {<br>
				            "href": "https://api-sandbox.slimpay.net/alps/v1/orders"<br>
				        },<br>
				        "https://api.slimpay.net/alps#get-order-items": {<br>
				            "href": "https://api-sandbox.slimpay.net/orders/a621cee0-d679-11e6-bd80-000000000001/order-items"<br>
				        }
				    }
				}
				</p>

				<h1>Creditor</h1>

				<p>Description: A creditor representation. A creditor is, most of the time, a merchant.</p>

				<h2>reference</h2>
				<p>The creditor reference within the SlimPay referential. This reference is given by SlimPay. Constraints: Text, 35 characters or less, Read-Write.</p>

				<h1>Subscriber</h1>
				<p>We still offer a very basic, yet powerful payment-to-customer relation via the subscriber reference parameter. This value must be provided by you and it should be unique per customer.</p>

				<h1>payment schemes</h1>
				<p>A payment scheme is a set of rules and technical standards for the execution of payment transactions that have to be followed by adhering payment service providers.<br><br>As a Payment Service Provider, SlimPay supports the following schemes:</p>
				<ul>
					<li>SEPA Direct Debit : <br>Le prélèvement SEPA permet aux créanciers d’effectuer des prélèvements sur un compte de la zone SEPA (France ou autre), dans les mêmes conditions de prix, de délai d’exécution, de qualité et de sécurité qu’une opération entre deux comptes en France. Le prélèvement SEPA est souvent désigné par l'abréviation SDD (SEPA Direct Debit)<br> <a href="http://www.mesfluxdepaiement.fr/sepa/le-prelevement-sepa" target="_blank">Docu officiel</a></li>
					<li>SEPA Credit Transfer</li>
					<li>BACS Direct Debit</li>
				</ul> 

				<h1>Mandates</h1>
				<p><a href="https://dev.slimpay.com/hapi/reference/mandates" target="_blank">https://dev.slimpay.com/hapi/reference/mandates</a></p>
				<p>A mandate represents the authorization given by a debtor to a creditor to collect on its bank account. The creation and signature of a mandate is controlled by an order resource with signMandate order item. A payment (direct debit) is possible only if the related mandate is in state "active".</p>

				<h2>Request</h2>

				<p>POST follow(https://api.slimpay.net/alps#create-mandates) HTTP/1.1<br>
					Accept: application/hal+json; profile="https://api.slimpay.net/alps/v1"<br>
					Content-Type: application/json<br>
					Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29w<br>ZSI6WyJhcGkiXSwiZXhwIjoxNDg4NDc0NzI1LCJqdGkiOiI3OThh<br>NGEyYy1hOGE4LTQwNmItOGY0YS1mMjE3ZmNhMTM5YjciLCJjbGllbnRfaWQiOi<br>JkZW1vY3JlZGl0b3IwMSJ9.VoN5FoWOoPfLkJU15ZIcYp2iRam4WJoVfMBw_35XCkw
					<br>

					{<br>
					    "dateSigned": "2015-08-26T08:47:53.925+0000",<br>
					    "createSequenceType": "FRST",<br>
					    "creditor": {<br>
					        "reference": "democreditor"<br>
					    },<br>
					    "subscriber": {<br>
					        "reference": "subscriber01"<br>
					    },<br>
					    "signatory": {<br>
					        "honorificPrefix": "Mr",<br>
					        "familyName": "Doe",<br>
					        "givenName": "John",<br>
					        "telephone": "+33612345678",<br>
					        "email": "change.me@slimpay.com",<br>
					        "billingAddress": {<br>
					            "street1": "27 rue des fleurs",<br>
					            "street2": "Bat 2",<br>
					            "postalCode": "75008",<br>
					            "city": "Paris",<br>
					            "country": "FR"<br>
					        },
					        "bankAccount": {<br>
					            "bic": "DEUTFRPP",<br><br>
					            "iban": "FR7616348000011523645985206"<br>
					        }<br>
					    }<br>
					}</p>

			<?php	

			endwhile;

		else:

	  		get_template_part( 'page-templates-parts/content', 'none' );

		endif;
		?>
		
	</div>
</div>

<?php get_footer(); ?>

