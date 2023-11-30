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
		'description' => 'Sara Sperandio - Laboratori e psicologia',
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

	'navigation_links' => [
		['type' => 'link', 'label' => 'Home', 'url' => 'home', 'location_tag' => 'home', 'admin_only' => false],
		['type' => 'link', 'label' => 'Servizi', 'url' => 'services', 'location_tag' => 'services', 'admin_only' => false],
		['type' => 'link', 'label' => 'Pet Therapy', 'url' => 'pet-therapy', 'location_tag' => 'pet-therapy', 'admin_only' => false],
		['type' => 'link', 'label' => 'Videocorsi', 'url' => 'courses', 'location_tag' => 'courses', 'admin_only' => false],
		['type' => 'link', 'label' => 'Contatti', 'url' => 'contacts', 'location_tag' => 'contacts', 'admin_only' => false],
		['type' => 'button', 'label' => ['Login', '{{ $username }}'], 'url' => 'login', 'location_tag' => 'login', 'admin_only' => false],
	],

	/*
    |--------------------------------------------------------------------------
    | Social media
    |--------------------------------------------------------------------------
    |
    |
    */

	'social_media' => [
		'instagram' => ['url' => 'https://www.instagram.com/dott.ssa_sara_neuropsicologa/', 'label' => '@dott.ssa_sara_neuropsicologa',],
		'facebook' => ['url' => 'https://www.facebook.com/Studiodipsicologiacollaborando', 'label' => 'Studio Collaborando',],
		'email' => ['url' => 'mailto:sara.sperandio92@gmail.com', 'label' => 'sara.sperandio92@gmail.com',],
		'whatsapp' => ['url' => 'https://wa.me/393465266969', 'label' => '346 5266969',],
		'phone' => ['url' => 'tel:346 5266969', 'label' => '346 5266969',],
	],
];
