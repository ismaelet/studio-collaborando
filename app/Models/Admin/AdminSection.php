<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;

/**
 * Admin section class
 */
class AdminSection extends Model {

	/**
	 * The attributes that are mass assignable
	 */
	protected $fillable = ['category_id', 'name', 'subsection', 'type', 'order', 'hidden', 'for_supervisors'];

	/**
	 * Get the category
	 */
	public function category(): BelongsTo {
		return $this->belongsTo(AdminCategory::class);
	}

	/**
	 * Get the url
	 */
	public function url(): ?string {
		$routeName = implode('.', array_filter(['admin', $this->category->slug, $this->subsection, $this->type]));

		if (Route::has($routeName)) {
			return route($routeName);
		}

		return null;
	}

	/**
	 * Get the section by slug
	 */
	public static function findBySlug(string $slug): ?self {
		$slug = str_replace('admin.', '', $slug);
		$slug = explode('.', $slug);
		$categorySlug = $slug[0];
		$subsectionSlug = count($slug) > 2 ? $slug[1] : '';
		$typeSlug = end($slug);

		return self::join('admin_categories', 'admin_sections.category_id', '=', 'admin_categories.id')
			->where('admin_categories.slug', $categorySlug)
			->where('admin_sections.subsection', $subsectionSlug)
			->where('admin_sections.type', $typeSlug)
			->select('admin_sections.*')
			->first();
	}
}
