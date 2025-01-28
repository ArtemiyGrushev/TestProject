<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    protected string $directory = 'private/exports';

    public function index()
    {

        $directory = storage_path('app/' . $this->directory);

        $files = File::files($directory);
        $xmlFiles = array_filter($files, function ($file) {
            return $file->getExtension() === 'xml' && strpos($file->getFilename(), 'order_') === 0;
        });

        $xmlFileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $xmlFiles);

        sort($xmlFileNames);

        return view('files.index', ['files' => $xmlFileNames]);
    }

    public function download(string $filename)
    {
        // Путь к файлу
        $filePath = storage_path('app/' . $this->directory . '/' . $filename);

        if (!File::exists($filePath)) {
            abort(404, 'Файл не найден');
        }

        return response()->download($filePath);
    }
}
