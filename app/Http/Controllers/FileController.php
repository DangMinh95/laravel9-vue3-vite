<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function multiUploadFile(Request $request)
    {
        $files = $request->file('files');

        try {
            foreach ($files as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $folderName = Auth::user()->name . "_" . Auth::user()->id;
                Storage::putFileAs($folderName, $file, $fileName);
                $pathFile = config('common.filePath') . $folderName . '/' . $fileName;
            }
        } catch (\Exception $e) {
//            dd($e->getMessage());
            return response()->json([
                'errorCode' => config('errorcode.servererror'),
                'message' => 'Lỗi serve, bạn truy cập lại sau'
            ]);
        }

        return response()->json([
            'errorCode' => 0,
            'message' => 'Tải tệp tin thành công'
        ]);
    }

    public function uploadImage(FileRequest $request)
    {
        $params = $request->only(['imagebase64']);
        $base64code = explode(',', $params['imagebase64'])[1];
    }
}
