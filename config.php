<?php
/* PARAMETRES BASE DE DONNEE */
// Hostname de la DB
define('db_host','localhost');
// Nom d'utilisateur
define('db_user','root');
// Mot de passe
define('db_pass','');
// Nom de la DB
define('db_name','shoppingcart_advanced');

/* PARAMETRES GENERAUX */
// Titre du site
define('site_name','Shopping Cart');
// Devise monétaire employée (euros par défaut) :  http://cactus.io/resources/toolbox/html-currency-symbol-codes
define('currency_code','&euro;');
// Image du hero sur la page d'accueil
define('featured_image','imgs/featured-image.jpg');
// Compte requis pour commander ? (oui par défaut)
define('account_required',true);
// L'adresse e-mail qui apparait dans l'e-mail de confiramtion de commande.
define('mail_from','noreply@yourwebsite.com');
// Activer l'envoi de mails ? (oui par défaut)
define('mail_enabled',true);
// Rewrite URL? (!OPTION A CREUSER!)
define('rewrite_url',false);

/* PARAMETRES PAIEMENT PAYPAL */
// Accepter les paiements PAYPAL? (oui par défaut)
define('paypal_enabled',true);
// Adresse paypal pour la réception des virements.
define('paypal_email','payments@yourwebsite.com');

// If the test mode is set to true it will use the PayPal sandbox website, which is used for testing purposes.
// Read more about PayPal sandbox here: https://developer.paypal.com/developer/accounts/
// Set this to false when you're ready to start accepting payments on your business account
define('paypal_testmode',true);
// Devise monétaire à utiliser avec Paypal. (USD par défaut)
define('paypal_currency','EUR');
// PayPal IPN url, this should point to the IPN file located in the "ipn" directory
define('paypal_ipn_url','https://yourwebsite.com/ipn/paypal.php');
// PayPal cancel URl, the page the customer returns to when they cancel the payment
define('paypal_cancel_url','https://yourwebsite.com/cart');
// PayPal return URL, the page the customer returns to after the payment has been made:
define('paypal_return_url','https://yourwebsite.com/placeorder');

/* PARAMETRES PAIEMENT STRIPE (DESACTIVE) */
// Accepter les paiements via STRIPE ?
define('stripe_enabled',false);
// Clef API secrète stripe
define('stripe_secret_key','');
// Clef API publique stripe
define('stripe_publish_key','');
// Devise utilisée par Stripe
define('stripe_currency','EUR');
// Stripe IPN url, this should point to the IPN file located in the "ipn" directory
define('stripe_ipn_url','https://yourwebsite.com/ipn/stripe.php');
// PayPal cancel URl, the page the customer returns to when they cancel the payment
define('stripe_cancel_url','https://yourwebsite.com/cart');
// PayPal return URL, the page the customer returns to after the payment has been made
define('stripe_return_url','https://yourwebsite.com/placeorder');
?>
