<?php 

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class UploadHelper
{
	public static function uploadImage($file)
	{
		$img_name = time() . '_' . $file->getClientOriginalName();
        Storage::put('public/image/' . $img_name, file_get_contents($file));

        return $img_name;
	} 

	public static function updateImage($file, $oldName)
	{
		// Delte Old Image
		Storage::delete('public/image/'.$oldName);
		
		// Update with new Image
		$img_name = time() . '_' . $file->getClientOriginalName();
		Storage::put('public/image/' . $img_name, file_get_contents($file));

		return $img_name;
	}

	public static function deleteImage($name)
	{
		Storage::delete('public/image/' . $name);
	}

	public static function uploadPdf($file)
	{
		$pdf_name = time() . '_' . $file->getClientOriginalName();
        Storage::put('public/file/' . $pdf_name, file_get_contents($file));

        return $pdf_name;
	}

	public static function updatePdf($file, $oldFile)
	{
		// Delete Old Pdf
		Storage::delete('public/file/'.$oldFile);

		// Update with new Pdf
		$pdf_name = time() . '_' . $file->getClientOriginalName();
		Storage::put('public/file/' . $pdf_name, file_get_contents($file));

		return $pdf_name;
	}

	public static function deletePdf($name)
	{
		Storage::delete('public/file/'.$name);
	}
}