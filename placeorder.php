<?php
// Prevent direct access to file
defined('shoppingcart') or exit;
// Remove all the products in cart, the variable is no longer needed as the order has been processed
unset($_SESSION['cart']);
?>
<?=template_header('Place Order')?>

<?php if ($error): ?>
<p class="content-wrapper error"><?=$error?></p>
<?php else: ?>
<div class="placeorder content-wrapper">
    <h1>Votre réservation a bien été effectuée</h1>
    <p>Merci pour votre réservation, vous recevrez votre confirmation d'ici 15 minutes.</p>
</div>
<?php endif; ?>

<?=template_footer()?>
