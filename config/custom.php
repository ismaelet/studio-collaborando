<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Meta Data
    |--------------------------------------------------------------------------
    |
    |
    */

	'meta_data' => [
		'full_name' => env('APP_FULL_NAME', ''),
		'description' => env('APP_DESCRIPTION', ''),
		'short_description' => env('APP_SHORT_DESCRIPTION', ''),
		'default_color_scheme' => env('APP_COLOR_SCHEME', 'light'),
	],

	/*
    |--------------------------------------------------------------------------
    | Navigation settings
    |--------------------------------------------------------------------------
    |
    |
    */
	'header_components' => [
		'desktop' => [['logo'], [], ['desktop_navigation']],
		'mobile' => [['logo'], [], ['hamburger_icon']],
	],

	'header_navigation_links' => [
		['type' => 'link', 'label' => 'Home', 'route' => 'home', 'location_tag' => 'home', 'admin_only' => false],
		['type' => 'link', 'label' => 'Servizi', 'route' => 'services', 'location_tag' => 'services', 'admin_only' => false],
		['type' => 'link', 'label' => 'Pet Therapy', 'route' => 'pet-therapy', 'location_tag' => 'pet-therapy', 'admin_only' => false],
		['type' => 'link', 'label' => 'Videocorsi', 'route' => 'courses', 'location_tag' => 'courses', 'admin_only' => false],
		['type' => 'link', 'label' => 'Contatti', 'route' => 'contacts', 'location_tag' => 'contacts', 'admin_only' => false],
		['type' => 'link', 'label' => 'Gestione', 'url' => 'admin', 'location_tag' => 'admin', 'admin_only' => true],
		['type' => 'button', 'label' => 'Login', 'route' => 'login', 'location_tag' => 'login', 'auth' => false, 'admin_only' => false],
		['type' => 'button', 'label' => '{{ $username }}', 'route' => 'user-dashboard', 'location_tag' => 'user-dashboard', 'auth' => true, 'admin_only' => false],
	],

	'footer_navigation_links' => [
		'Navigazione' => [
			['label' => 'Home', 'url' => 'home',],
			['label' => 'Servizi', 'url' => 'services',],
			['label' => 'Pet Therapy', 'url' => 'pet-therapy',],
			['label' => 'Videocorsi', 'url' => 'courses',],
		],
		'Legali' => [
			['label' => 'Privacy policy', 'url' => 'privacy'],
			['label' => 'P. IVA 02392550220'],
		],
		'Contatti' => [
			['label' => 'Contattaci', 'url' => 'contacts'],
			['social_media' => 'email',],
			['social_media' => 'phone',],

		],
		'Seguici' => [
			['social_media' => 'instagram', 'icon' => true],
			['social_media' => 'facebook', 'icon' => true],
			['social_media' => 'whatsapp', 'icon' => true],
		],
	],

	/*
    |--------------------------------------------------------------------------
    | Social media
    |--------------------------------------------------------------------------
    |
    |
    */
	'social_media' => [
		'instagram' => ['url' => 'https://www.instagram.com/dott.ssa_sara_neuropsicologa/', 'label' => 'instagram',],
		'facebook' => ['url' => 'https://www.facebook.com/Studiodipsicologiacollaborando', 'label' => 'facebook',],
		'email' => ['url' => 'mailto:sara.sperandio92@gmail.com', 'label' => 'sara.sperandio92@gmail.com',],
		'whatsapp' => ['url' => 'https://wa.me/393465266969', 'label' => 'whatsapp',],
		'phone' => ['url' => 'tel:346 5266969', 'label' => 'Tel. 346 5266969',],
	],

	/*
    |--------------------------------------------------------------------------
    | Ecommerce data
    |--------------------------------------------------------------------------
    |
    |
    */
];
