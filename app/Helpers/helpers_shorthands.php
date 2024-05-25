<?php

use App\Helpers\ArrayHelper;
use Illuminate\Support\Facades\Auth;

/**
 * Check if the user is an admin
 * 
 * @return bool Whether the user is an admin
 */
function is_admin(): bool {
	return Auth::check() && Auth::user()->isAdmin();
}

/**
 * Check if the user is a superadmin
 * 
 * @return bool Whether the user is a superadmin
 */
function is_superadmin(): bool {
	return Auth::check() && Auth::user()->isSuperadmin();
}

/**
 * Explode a string by the last occurrence of a separator
 * 
 * @param string $separator The separator to explode the string by
 * @param string|null $string The string to explode
 */
function explode_last($separator, $string): array {
	return ArrayHelper::explodeLast($separator, $string);
}
