<?php
/**
 * Enqueue scripts and styles with conditionnal REMOTE_ADDR.
 */
function twenty20_styles_scripts() {

	// IF developping on localhost clear browser’s cache often, ELSE once a week
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
		$twenty20_fakeVersionNumber = date('yzHi.s'); // every seconds
	} else {
		$twenty20_fakeVersionNumber = date('y.W');
	}

	// Register CSS
	wp_register_style( 'sass-compiled-screen', get_stylesheet_directory_uri() . '/assets/css/theme.css', array(), $twenty20_fakeVersionNumber, 'screen');
	wp_register_style( 'sass-compiled-print', get_stylesheet_directory_uri() . '/assets/css/prints.css', array(), $twenty20_fakeVersionNumber, 'print');

	// Enqueue CSS
	wp_enqueue_style( 'sass-compiled-screen' );
	wp_enqueue_style( 'sass-compiled-print' );

	// Enqueue JS
	wp_enqueue_script( 'twenty20-js', get_template_directory_uri() . '/assets/js/theme.js', array(), $twenty20_fakeVersionNumber, true );
}
add_action( 'wp_enqueue_scripts', 'twenty20_styles_scripts' );


/**
 * Advanced Custom Fields PRO (required plugin)
 * @link https://www.advancedcustomfields.com/my-account/view-licenses/
 * PRO licence key = MGI5ZjRjMWFmMGQ4NmJiNGU5ZTQ5YTA1ZWE1OTM5M2YwZTFjMGQxOTIyMDc5YzBhYWU5M2Zi
 */
if( function_exists('acf_add_local_field_group') ):

// Product Price
$acf_productPrice_key	= 'group_617049954de37';
// Product Specifications
$acf_productSpecs_key	= 'group_616dbd35445ef';
// Tag
$acf_saqTag_key			= 'group_616f283c339f1';


	acf_add_local_field_group(array(
		'key' => $acf_productPrice_key,
		'title' => __('Prix et inventaire', 'Price and inventory', 'twenty20 product'),
		'fields' => array(
			array(
				'key' => 'field_61704a1340091',
				'label' => __('Prix (taxes incluses)', 'Price (taxes included)', 'twenty20 product'),
				'name' => 'price',
				'type' => 'number',
				'instructions' => 'Dollars',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'price',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '$',
				'prepend' => '',
				'append' => '$',
				'min' => '',
				'max' => '',
				'step' => 0,
			),
			array(
				'key' => 'field_61704e8ce1a7d',
				'label' => __('Cents', 'twenty20 product'),
				'name' => 'pricecents',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'pricecents',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '¢',
				'prepend' => '',
				'append' => '¢',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_61704ad140092',
				'label' => __('Inventaire', 'Inventory', 'twenty20 product'),
				'name' => 'visibility',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'visibility',
					'id' => '',
				),
				'message' => __('au publique', 'for the public', 'twenty20 product'),
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => __('Afficher', 'Show', 'twenty20 product'),
				'ui_off_text' => __('Dissimuler', 'Hide', 'twenty20 product'),
			),
			array(
				'key' => 'field_61704dbe64d53',
				'label' => __('Quantité', 'Quantity', 'twenty20 product'),
				'name' => 'qty',
				'type' => 'number',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_61704ad140092',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => 'qty',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'singular-product.php',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => $acf_productSpecs_key,
		'title' => __('Détails du produit', 'Product details', 'twenty20 product'),
		'fields' => array(
			array(
				'key' => 'field_616dbe3f760b4',
				'label' => __('Type de vin', 'Wine type', 'twenty20 product'),
				'name' => 'winetype',
				'type' => 'button_group',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'winetype',
					'id' => '',
				),
				'choices' => array(
					'vin_blanc' 		=> __('Vin blanc', 'White wine,', 'twenty20 product'),
					'vin_rouge' 		=> __('Vin rouge', 'Red wine,', 'twenty20 product'),
					'vin_rose' 			=> __('Vin rosé', 'Rosé wine', 'twenty20 product'),
					'vendange_tardive' 	=> __('Vendange tardive', 'Vendange tardive (VT)', 'twenty20 product'),
				),
				'allow_null' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_616dc5bd760b5',
				'label' => __('Cépage(s)', 'Grape variety(s)', 'twenty20 product'),
				'name' => 'cepages',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'cepages',
					'id' => '',
				),
				'choices' => array(
					'frontenac_blanc' 	=> 'Frontenac blanc',
					'frontenac_gris' 	=> 'Frontenac gris',
					'frontenac_noir' 	=> 'Frontenac noir',
					'marquette' 		=> 'Marquette',
					'petite_perle' 		=> 'Petite perle',
					'pinot_gris' 		=> 'Pinot gris',
					'pinot_noir' 		=> 'Pinot noir',
					'swenson_white' 	=> 'Swenson white',
					'vidal' 			=> 'Vidal',
				),
				'allow_custom' => 1,
				'save_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_616dcb28760b6',
				'label' => __('Millésime', 'Vintage', 'twenty20 product'),
				'name' => 'vintage',
				'type' => 'radio',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'vintage',
					'id' => '',
				),
				'choices' => array(
					2019 => '2019',
					2020 => '2020',
					2021 => '2021',
				),
				'allow_null' => 0,
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_616dccaf760b8',
				'label' => __('Degré d’alcool', 'Percentage of alcohol', 'twenty20 product'),
				'name' => 'alcohol',
				'type' => 'text',
				'instructions' => __('Seulement un chiffre après la virgule. Si aucun alcool entrez le chiffre 0.', 'Only one digit after the decimal point. If no alcohol enter the number 0.', 'twenty20 product'),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'alcohol',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '% alc./vol.',
				'maxlength' => 5,
			),
			array(
				'key' => 'field_616ddc5770f4d',
				'label' => __('Sucre', 'Sugar', 'twenty20 product'),
				'name' => 'sugar',
				'type' => 'text',
				'instructions' => __('Grammes par litre. (champ optionel)', 'Grams per liter. (optional field)', 'twenty20 product'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'sugar',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => 'g/L.',
				'maxlength' => 4,
			),
			array(
				'key' => 'field_616f23c626c45',
				'label' => __('Format', 'Size', 'twenty20 product'),
				'name' => 'size',
				'type' => 'radio',
				'instructions' => '(ml)',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'size',
					'id' => '',
				),
				'choices' => array(
					750 => '750',
					500 => '500',
				),
				'allow_null' => 0,
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_616f20fef2328',
				'label' => __('Bouteille', 'Bottle', 'twenty20 product'),
				'name' => 'bottle',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'bottle-details',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_616f212df2329',
						'label' => __('Poids', 'Weight', 'twenty20 product'),
						'name' => 'weight',
						'type' => 'radio',
						'instructions' => __('(g) Bouteille pleinne et encapsulée', '(g) Full and encapsulated bottle', 'twenty20 product'),
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => 'weight',
							'id' => '',
						),
						'choices' => array(
							1150 => '1150',
							935 => '935',
						),
						'allow_null' => 0,
						'other_choice' => 1,
						'save_other_choice' => 1,
						'default_value' => 1150,
						'layout' => 'horizontal',
						'return_format' => 'value',
					),
					array(
						'key' => 'field_616f21aaf232a',
						'label' => __('Hauteur', 'Height', 'twenty20 product'),
						'name' => 'height',
						'type' => 'radio',
						'instructions' => __('(cm) Incluant le bouchon', '(cm) Including the cap', 'twenty20 product'),
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => 'height',
							'id' => '',
						),
						'choices' => array(
							'30,5' => '30,5',
							'?2?' => '?2?',
						),
						'allow_null' => 0,
						'other_choice' => 1,
						'save_other_choice' => 1,
						'default_value' => '30,5',
						'layout' => 'horizontal',
						'return_format' => 'value',
					),
					array(
						'key' => 'field_616f21dff232b',
						'label' => __('Diamètre', 'Diameter', 'twenty20 product'),
						'name' => 'diameter',
						'type' => 'radio',
						'instructions' => '(cm)',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => 'diameter',
							'id' => '',
						),
						'choices' => array(
							'7,3' => '7,3',
							'?2?' => '?2?',
						),
						'allow_null' => 0,
						'other_choice' => 1,
						'save_other_choice' => 1,
						'default_value' => '7,3',
						'layout' => 'horizontal',
						'return_format' => 'value',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'singular-product.php',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'discussion',
			1 => 'comments',
			2 => 'author',
			3 => 'format',
			4 => 'send-trackbacks',
		),
		'active' => true,
		'description' => __('Spécifications affichées sur nos étiquettes', 'Specifications displayed on our labels', 'twenty20 product'),
	));

	acf_add_local_field_group(array(
		'key' => $acf_saqTag_key,
		'title' => __('Tag SAQ', 'SAQ tag', 'twenty20 product'),
		'fields' => array(
			array(
				'key' => 'field_616f2911f6b51',
				'label' => __('Pastille de goût de la SAQ', 'SAQ taste tag', 'twenty20 product'),
				'name' => 'saqtag',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'saqtag',
					'id' => 'saq-tag',
				),
				'choices' => array(
					'fruit-light' 			=> __('Fruité et léger', 'Fruity and Light', 'twenty20 product'),
					'fruit-medium-bodied' 	=> __('Fruité et généreux', 'Fruity and Medium-Bodied', 'twenty20 product'),
					'aromatic-supple' 		=> __('Aromatique et souple', 'Aromatic and Supple', 'twenty20 product'),
					'aromatic-robust' 		=> __('Aromatique et charnu', 'Aromatic and Robust', 'twenty20 product'),
					'delicate-light' 		=> __('Délicat et léger', 'Delicate and Light', 'twenty20 product'),
					'fruity-vibrant' 		=> __('Fruité et vif', 'Fruity and Vibrant', 'twenty20 product'),
					'aromatic-mellow' 		=> __('Aromatique et rond', 'Aromatic and Mellow', 'twenty20 product'),
					'fruity-sweet' 			=> __('Fruité et doux', 'Fruity and Sweet', 'twenty20 product'),
					'fruity-extra-sweet' 	=> __('Fruité et extra-doux', 'Fruity and Extra Sweet', 'twenty20 product'),
				),
				'allow_null' => 1,
				'other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'singular-product.php',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'field',
		'hide_on_screen' => '',
		'active' => true,
		'description' => __('Pastilles de goût', 'Taste tags', 'twenty20 product'),
	));

endif;