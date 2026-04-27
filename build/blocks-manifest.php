<?php
// This file is generated. Do not modify it manually.
return array(
	'wing-services-list' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/wing-services-list',
		'version' => '0.1.0',
		'title' => 'Wing Services List',
		'category' => 'design',
		'icon' => 'screenoptions',
		'description' => 'Display a grid of services with titles, descriptions, and images.',
		'keywords' => array(
			'services',
			'grid',
			'cards',
			'wing'
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			)
		),
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Our Services'
			),
			'subheading' => array(
				'type' => 'string',
				'default' => 'Everything you need to grow online'
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'services' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => 'service-1',
						'title' => 'Service One',
						'description' => 'A short description of this service.',
						'imageId' => 0,
						'imageUrl' => '',
						'imageAlt' => '',
						'linkUrl' => '',
						'linkLabel' => 'Learn More',
						'linkOpenInNewTab' => false
					),
					array(
						'id' => 'service-2',
						'title' => 'Service Two',
						'description' => 'A short description of this service.',
						'imageId' => 0,
						'imageUrl' => '',
						'imageAlt' => '',
						'linkUrl' => '',
						'linkLabel' => 'Learn More',
						'linkOpenInNewTab' => false
					),
					array(
						'id' => 'service-3',
						'title' => 'Service Three',
						'description' => 'A short description of this service.',
						'imageId' => 0,
						'imageUrl' => '',
						'imageAlt' => '',
						'linkUrl' => '',
						'linkLabel' => 'Learn More',
						'linkOpenInNewTab' => false
					)
				)
			)
		),
		'textdomain' => 'wing-services-list',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	)
);
