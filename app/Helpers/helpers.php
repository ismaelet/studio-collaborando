<?php

use Illuminate\Support\Facades\File;

/**
 * Import an svg file
 */
function import_svg($filename) {
	echo str_replace('<svg', '<svg class="embedded-svg"', File::get(resource_path('svg/' . $filename . '.svg')));
}
