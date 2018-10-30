<?php

if( have_rows('sections') ): 
	while( have_rows('sections') ): the_row();

		switch( get_row_layout() ) {
			case 'hero':
				get_template_part('sections/section', 'hero');
				break;
			case 'image':
				get_template_part('sections/section', 'image');
				break;
			case 'title':
				get_template_part('sections/section', 'title');
				break;
			case 'wysiwyg':
				get_template_part('sections/section', 'wysiwyg');
				break;
		}

	endwhile;
endif;

?>
