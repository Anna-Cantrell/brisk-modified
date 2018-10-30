<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

//
// Section options
//

$section_options = new FieldsBuilder('options');
$section_options
	->addTab('Options')
	->addRadio('layout',
		['instructions' => 'Determines the width of the content.'])
		->addChoice('','Default')
		->addChoice('normal','Normal')
		->addChoice('wide','Wide')
		->addChoice('full','Full')
		->addChoice('narrow','Narrow')
	->addText('classes',
		['placeholder' => 'section--featured']);

//
// Sections, ordered alphabetically
//

// Hero
$hero = new FieldsBuilder('hero');
$hero
	->addText('title')
	->addImage('background_image')
	->addFields($wysiwyg)
	->addLink('cta', ['label'=>'Call to Action']);

$image = new FieldsBuilder('image');
$image
	->addImage('image');

// Title
$title = new FieldsBuilder('title');
$title
	->addText('page_title')
	->addText('subtitle');

// WYSIWYG
$wysiwyg = new FieldsBuilder('wysiwyg');
$wysiwyg
	->addWysiwyg('content');

//
// Build out sections
//

$sections = new FieldsBuilder('sections');
$sections
	->addFlexibleContent('sections')
		->addLayout('hero')
			->addTab('Content')
			->addFields($hero)
			->addFields($section_options)
		->addLayout('image')
			->addTab('Content')
			->addFields($image)
			->addFields($section_options)
		->addLayout('title', ['min' => 1])
			->addTab('Content')
			->addFields($title)
			->addFields($section_options)
		->addLayout('wysiwyg', ['label'=>'WYSIWYG'])
			->addTab('Content')
			->addFields($wysiwyg)
			->addFields($section_options);

$page_options = new FieldsBuilder('page_options');
$page_options
	->addWysiwyg('teaser',[
		'instructions' => 'Appears in lists.',
		'media_upload' => 0
	]);

//
// Page content
//

$page = new FieldsBuilder('page');
$page
	->addTab('Page Content')
	->addFields($sections)
	->addTab('Page Options')
	->addFields($page_options)
	->setLocation('post_type', '==', 'page')
		->or('post_type', '==', 'post');

add_action('acf/init', function() use ($page) {
	acf_add_local_field_group($page->build());
});
