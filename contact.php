
<?php 
/*
Template Name: -CONTACTO-
*/	
get_header();?>

<?php    

if(isset($_POST['SubmitButton'])){ //check if form was submitted
	$name = $_POST['contactName'];
	$email = $_POST['contactEmail'];
	$mensj = $_POST['contactMesj']; //get input text

	//php mailer variables
	$to = 'social@ecosistemaurbano.com';
	$subject = "Mensaje enviado desde: ".get_bloginfo('name');
	$headers = 'De: '. $email . "\r\n" .
	  'Responder a: ' . $email . "\r\n";


	$sent = wp_mail($to, $subject, strip_tags($mensj), $headers);
	if($sent){
		$yay="Gracias por tu mensaje ".$name.".Nos pondremos en contacto a la brevedad posible.";
	}
	
	else {
		$yay="Tu mensaje no ha sido enviado, por favor vuelve a intentarlo";
	}
		
} else{
	$yay=" ";
}   

?>
<main>
	<article class="customContainer">
		<?php while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title();?></h3>
			<?php the_content();?>

			<form class="contact-form" id="contactForm" method="post" action="<?php the_permalink(); ?>" >
				<div class="form-group">
					 <label for="contactNam">Nombre</label>
					 <input type="text" name="contactName" id="contactNam" value="<?php echo htmlspecialchars($_POST['name']); ?>" class="form-control" >
				</div>
				<div class="form-group">
					 <label for="contactEmail">Email</label>
					 <input type="email" name="contactEmail" id="contactEmail" value="<?php echo htmlspecialchars($_POST['email']); ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="contactMesj">Mensaje</label>
					<textarea class="form-control" id="contactMesj" name="contactMesj" value="<?php echo htmlspecialchars($_POST['mensj']); ?>" rows="9"></textarea>
				</div>
				<div class="form-group">
					<?php echo "<p class='bg-success'>$yay</p>";?>
				</div>

				<button type="submit" name="SubmitButton" class="btn btn-default">Enviar Mensaje</button>
			</form>

		<?php endwhile; // end of the loop. ?>
	</article>
</main>

<?php get_footer(); ?>