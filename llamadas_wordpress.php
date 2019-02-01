<!--Resumen de las distintas llamadas de  Wordpress-->

<!--///////////// LLamadas para la realización del header.php //////////////-->

<!--En el header en especifico en el head se utlizan
las siguienetes llamadas de Wordpress:
-->
<!--LLamada para el title-->
<?php bloginfo('name');?>

<!--llamada para la descripción de la página-->
<?php bloginfo('description');?>

<!--LLamada para obtener la ruta hacia la hoja de estilo "style.css"-->
<?php bloginfo('stylesheet_url');?>
<!-- 'stylesheet_url' Me devuelve la sigiente dirección
 http://localhost/wp_inicio/content/themes/themes_query_01/style.css-->

<!--Llamada para indicar una ruta hacia una carpeta ejemplo:
http://localhost/wp_inicio/content/themes/themes_query_01/imagenes/logo.png
-->
<img src="<?php bloginfo('template_url');?>/imagenes/logo.png" alt="Logo">

<!--Tambien con la llamada "template_url", puedo conectarme hacia archivos de javaScript ejemplo
http://localhost/wp_inicio/content/themes/themes_query_01/js/jquery.js
-->
<script src="<?php bloginfo('template_url');?>/js/jquery.js"></script>


<!--///////////// LLamadas para la realización del index.php //////////////-->

<!--La estructura más básica para hacer una llamada a la base de datos de worpdress,
en la cual rescato un Titulo, un contenido, el autor, la categoría, la fecha de publicación
es a treves de un loop ejemplo -->

<!--//////// LOOP ////////////////-->
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php // Aqui hago las llamadas para obtener la info de la publicación ejemplo ?>
        <?php the_permalink();?><!--LLamada que rescata la URL de una Publicación-->
        <?php the_title();?><!--LLama al titulo-->
        <?php the_content();?><!--recuperara el contenido y rescata imágen y texto de la publicación-->
        <?php the_autor();?><!--LLama el autor de la publicación-->
        <?php the_date();?><!--LLama a la fecha de publicación se debe configurar en español-->
        <?php the_excerpt();?><!--Llama a el resumen de la publicación-->

	<?php endwhile; ?>
			<!--Espacio para determinar la navegación para la visualizacón de los post si hay más de 10 post
            Se activa el NAV ejemplo-->
            <!--Prev post-->
		    <?php previous_post_link('%link', '%title', FALSE, 'excluded_cat_ids'); ?>
        	<!--Next post-->
            <?php next_post_link('%link', '%title', FALSE, 'excluded_cat_ids'); ?>

	<?php else : ?>

			<!--Si no hay Publciación debo indicar al usuario-->
        	<?php _e('Lo sentimos no hay publicación');?>

<?php endif; ?>
<!--/////////////////////////////////////LOOP///////////////////////////////////-->

<!--LOOP con filtrado de categoría y numero de Publicación Ejemplo-->
	<?php
	$my_query = new WP_Query('category_name=actualidad&showposts=1');
	while ($my_query->have_posts()):$my_query->the_post();$do_not_duplicate = $post->ID;?>

		<?php // Individual Post Styling ?>

	<?php endwhile; ?>
<!--LOOP con filtrado de categoría y numero de Publicación Ejemplo-->

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





<!--LLada para obtener la miniatura de una imagen insertada en un post (thumbnail)-->

<!--THUMBNAIL-->
<?php
	//Si hay miniatura insertada en la Publciación que va hacer ?
	if(has_post_thumbnail() )
	{
		//Si hay miniatura este va a mostrar la miniatura (thumbnail) y la va asociar a una clase
		the_post_thumbnail('thumbnail','class=miniatura_noticia');
	}

;?>
<!--THUMBNAIL-->

<!--Uso de los include para llamar las distintas partes de la estructura de un themes ejemplo-->
	<!--Include para llamar el header-->
    <?php get_header(); ?>

    <!--El header Hook le indica a los Plugins donde insertar estilos y jquery se inserta
        Antes de la etiqueta de cierre de el head-->
    <?php wp_head(); ?>

    <!--Include para llamar el sidebar-->
    <?php wp_sidebar();?>

    <!--Include para llamar el Footer-->
    <? get_footer()?>

    <!--El footer Hook le indica a los Plugins donde insertar estilos y jquery se inserta
        Antes de la etiqueta de cierre del body->
    <?php wp_footer(); ?>
<!--///////////// LLamadas para la realización del index.php //////////////-->

<!--///////////////// Llamadas del sidebar sidebar.php /////////////////-->
	<!--Para indicar que el sidebar sea una región editable y administrable a
    traves de los widgets del panle de Adminstración se escribe el siguiente Codigo-->
    <?php if (! dynamic_sidebar('Barra Lateral') ):?>
	<?php endif;?>

    <!--/////IMPORTANTE/////
    Se debe activar la funcion que habilita el panel de widgets en el admin de wordpress
    Revizar el codigo en el function
    -->
<!--///////////////// Llamadas del sidebar sidebar.php /////////////////-->

<!--//////////////// LLamadas para el Archivo functions.php ////////////-->
<!--Las funciones escritas en el Archivo functions.php deben estar dentro de la etiqueta de apertura de
php y de cierre de php ver el ejemplo con las funciones explicadas en clase-->
<?php

/*Funcion que habilita el panel de imagenes destacadas, para poder administrar las
imagenes asociadas a una publicación, estas se visualizan en el HOME o INDEX o dende este
el loop y en especifico en el "has_post_thumbnail"*/
add_theme_support('post-thumbnails');


/*Funcion que acorta la cantidad de palabras que se rescatan a traves de la
llamada the_excerpt()*/
function custom_excerpt_length( $length ) {
	//Me devuelve 20 palabras
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//Funcion para asignar un leer más a el resumen o Excerpt
function new_excerpt_more( $more ) {
	return ' <a class="leer_mas" href="'. get_permalink( get_the_ID() ) . '">Leer más</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

//Funcion que activa los widgets y define el area dinamica para adminsitrar los widgets
if(function_exists('register_sidebar')){
	register_sidebar(
		array(
		'name' => sprintf('Barra Lateral'),
		'before_widget' => '<li>',
		'after_widget'	=> '</li>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',

		));
}

// Para incluir el Plugins en el archivo function
function wpq_9537_admin_init() {

$file = WP_PLUGIN_DIR . '/Magic-Fields-2-master/mf_front_end.php';
    if ( file_exists( $file ) ) {
    require_once( $file );
    }
}
add_action( 'admin_init', 'wpq_9537_admin_init' );



// Registrar un widget
function arphabet_widgets_init() {
	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

//Para Llamar el widgets
<?php if ( is_active_sidebar( 'home_right_1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'home_right_1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>

;?>

<!--//////////////// LLamadas para el Archivo functions.php ////////////-->

<!--Codigos IMPORTANTES Y TRANSVERSALES-->
	<!--Codigo para Ingresar un campo Personalizado CUSTOM FIELDS-->
    <?php echo get_post_meta($post->ID,'banner',true);?>
<!--Codigos IMPORTANTES Y TRANSVERSALES-->


<!--CODIGO PARA LLAMAR A LAS PAGINAS FILTRADAS POR ID EN UN MENU-->
<?php wp_list_pages('include=105,82&title_li=');?>
<!--CODIGO PARA LLAMAR A LAS PAGINAS EN UN MENU-->

<!--//////////////// USO DE MAGIC FIELDS //////////////-->

<!--
   http://wiki.magicfields.org/doku.php?id=es:types_of_custom_fields_v20
   https://wordpress.org/plugins/magic-fields/
 -->
