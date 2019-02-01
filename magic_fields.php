<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title><?php bloginfo( $show = 'name')?></title>
  <link rel="stylesheet" type="text/css" href="<?php bloginfo( $show = 'stylesheet_url' ) ?>">
	<meta name="description" content="<?php bloginfo( $show = 'description' ) ?>">
</head>

  <body>

    <!--/////////////////////////////////////LOOP PARA MAGIC FILEDS///////////////////////////////////-->

    <!--  PRIMERA PARTE Codigo para que reconozca el Post Type del "Service" creado desde Magic Fields -->
    	 <?php
    	 		$args = array(
    	 				'post_type' => 'portafolio',
    	 				'posts_per_page' => 1,
    	 				'orderby' => 'rand'
    	 		);

    	 		$the_query = new WP_Query( $args );
    		?>
    <!--  PRIMERA PARTE Codigo para que reconozca el Post Type del "Service" creado desde Magic Fields -->

    <!--SEGUNDA PARTE PHP que genera el Loop, se deja antes de el HTML que desee que se repita-->
    <?php
    		 if ( $the_query->have_posts() ) :
    		 while ( $the_query->have_posts() ) : $the_query->the_post();
     ?>
     <h1><?php the_title();?></h1>
     <p><?php the_content(); ?></p>
     <!-- TERCERA PARTE PHP de inicio que recupera la información del grupo de Magic Fields -->
     <?php
    			 $column_2 = get_group('grupo_portafolio');
    			 if($column_2) {
    			 foreach($column_2 as $column_two){
             //PARAR QUE SALGA EL HTML HACIA FUERA DEL ECHO ESTE DEBE ESTAR ENTRE COMILLAS DOBLES O SIMPLES EJEMPLO:
             // echo '<h1></h1>';
             // PARA UNIR O CONCATENAR HTML Y LAS LLAMADAS  $column_two['grupo_portafolio_modales'][1] ESTAS DEBEN ESTAR
             // UNIDAD POR UN PUNTO EJEMPLO: echo '<h1>'.$column_two['grupo_portafolio_detalle_foto'][1].'</h1>'
    				 echo $column_two['grupo_portafolio_modales'][1].'<br>';
    				 echo '<img src="'.$column_two['grupo_portafolio_imagenes'][1]['thumb'].'">'.'<br>';
    				 echo $column_two['grupo_portafolio_detalle_foto'][1].'<br>';
             echo '<br><br>';


    			 }}
    	 ?>
     <!-- TERCERA PARTE PHP de inicio que recupera la información del grupo de Magic Fields -->

    <!--CUARTA PARTE CIERRE del PHP que genera el Loop, se deja al final del HTML que desee que se repita-->
    <?php endwhile; else:?>
    <?php endif;wp_reset_postdata();?>
     <!--CUARTA PARTE CIERRE del PHP que genera el Loop, se deja al final del HTML que desee que se repita-->

    <!--/////////////////////////////////////LOOP PARA MAGIC FILEDS///////////////////////////////////-->


<?php echo do_shortcode( '[contact-form-7 id="30" title="Contact form 1"]' ) ?>




  </body>
</html>
