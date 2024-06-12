<?php

namespace App\Http\Controllers;

use App\Models\MediaSosial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Intervention\Image\Facades\Image;
use App\Models\SambutanKepalaMadrasah;
use Illuminate\Support\Facades\Validator;

class SambutanKepalaMadrasahController extends Controller
{
    public function index(){
        $sambutan = SambutanKepalaMadrasah::find(1);
        $title = 'Data Sambutan Kepala Madrasah';

        return view('backend.sambutan_kepala_madrasah.index', compact('sambutan', 'title'));
    }

    /**
     * Update the sambutan data.
     *
     * @param Request $request The HTTP request object.
     * @param int $id The ID of the sambutan to update.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function update(Request $request, $id)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'judul' => 'required', // Sambutan title is required
            'isi' => 'required', // Sambutan content is required
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // Find the sambutan to update
        $sambutan = SambutanKepalaMadrasah::find($id);

        // Update sambutan data
        $sambutan->judul = $request->judul; // Update title
        $sambutan->isi = $request->isi; // Update content
        $sambutan->excerpt = Str::limit(strip_tags($request->isi), 500); // Generate excerpt

        // Process image upload if a file was uploaded
        if ($request->hasFile('gambar')) {
            $this->processImage($request, $sambutan); // Process image upload
        }
        // If no file was uploaded and a preview image exists, remove the image
        elseif ($request->gambarPreview == null && $sambutan->gambar != null) {
            $this->removeImage($sambutan);
        }
        // If a preview image exists and a file was not uploaded, rename the image
        elseif ($request->gambarPreview != null && $sambutan->gambar != null) {
            $this->renameImage($sambutan);
        }

        // Save the updated sambutan and return success or error response
        if ($sambutan->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sambutan Kepala Madrasah berhasil diubah!'
            ]);
        } else {
            return response()->json([
                'status' => 'error2',
                'message' => 'Sambutan Kepala Madrasah gagal diubah!'
            ]);
        }
    }

    private function processImage($request, $sambutan)
    {
        $this->removeImage($sambutan);

        $file_name = $this->generateFileName($request->judul, $request->gambar);
        Image::make($request->gambar)->resize(500, 500)->save(public_path('/upload/sambutan/'.$file_name));

        $sambutan->gambar = 'upload/sambutan/'.$file_name;
    }

    private function removeImage($sambutan)
    {
        if ($sambutan->gambar) {
            unlink($sambutan->gambar);
            $sambutan->gambar = null;
        }
    }

    private function renameImage($sambutan)
    {
        // get file extension
        $file_ext = pathinfo($sambutan->gambar, PATHINFO_EXTENSION);

        $file_name = $this->generateFileName($sambutan->judul, null, $file_ext);
        rename(public_path($sambutan->gambar), public_path('upload/sambutan/'.$file_name));

        $sambutan->gambar = 'upload/sambutan/'.$file_name;
    }

    private function generateFileName($judul, $file, $file_ext = null)
    {
        $judul_tanpa_spasi = str_replace(' ', '-', $judul);
        $file_name = $judul_tanpa_spasi.'-'.hexdec(uniqid());
        if ($file_ext) {
            $file_name .= '.'.$file_ext;
        } elseif ($file) {
            $file_name .= '.' . $file->getClientOriginalExtension();
        }

        return $file_name;
    }

    public function index_fe(){
        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        return view('frontend.profil.sambutan', compact('profil_sekolah'));
    }

    function fetch()
    {
        // get data user yang login
        $sambutan = SambutanKepalaMadrasah::find(1);

        return response()->json([
            'data' => $sambutan
        ]);
    }
}
