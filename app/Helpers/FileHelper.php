<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper {

	/**
	 * Move a file to the public storage directory
	 * 
	 * @param \Illuminate\Http\UploadedFile $file The file to move
	 * @param string $path The path to the file
	 * @return bool Whether the file was moved
	 */
	public static function upload(UploadedFile $file, string $filePath): bool {
		$fileDirectory = ArrayHelper::explodeLast('/', $filePath)[0];
		$fileName = ArrayHelper::explodeLast('/', $filePath)[1];

		if (Storage::disk('public')->exists($filePath)) {
			Storage::disk('public')->delete($filePath);
		}

		$storedFile = $file->storeAs($fileDirectory, $fileName, 'public');

		return (bool) $storedFile;
	}

	/**
	 * Check if a file exists in the storage
	 * 
	 * @param string $path The path to the file
	 * @return bool Whether the file exists
	 */
	public static function exists(string $path): bool {
		return Storage::disk('public')->exists($path);
	}

	/**
	 * Delete a file from the storage
	 * 
	 * @param string $path The path to the file
	 * @return bool Whether the file was deleted
	 */
	public static function delete(string $path): bool {
		return Storage::disk('public')->delete($path);
	}
}
