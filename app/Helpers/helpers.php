<?php

use Illuminate\Support\Facades\File;

/**
 * Import an svg file
 */
function import_svg($filename) {
	echo File::get(resource_path('svg/' . $filename . '.svg'));
}
