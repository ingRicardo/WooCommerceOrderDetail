<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		//	get_order_details(107);
			?>
			<button id="bt1" type="button" onclick='showMessage()'  >Get JSON!</button>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<div id=”test-script” class="content-area" style =" display: block;">
	<?php
	$order_detail = getOrderDetailById(103); //to get the detail of order ID #101
	$myJSON = json_encode($order_detail);
	$JSONENCODE = urlencode($myJSON);
	?>
	<script>
		var my_var = <?php echo json_encode($JSONENCODE); ?>;				
		function showMessage(){					
			alert(my_var);
			var http = new XMLHttpRequest();	
			var url = "http://localhost:8083/wcadapter/wc/v1/wc-jsonParser";
			var params = "data="+my_var;
			http.open("POST", url+"?"+params, true);
			//http.open("GET", url+"?"+params, true);
			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					alert(http.responseText);
				}
			}

			http.send(params);

			alert("Order sent to WCAdapter....");	

		}										
	</script>				
</div>
<?php
get_footer();
