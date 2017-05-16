<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{

	private $attachTypes = [
        'property' => '\App\Models\Foo',
        'listing'  =>'\App\Models\Bar',
        // ...
    ];

    public function upload(App\Http\Requests\PhotoUploadRequest $request, $type)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file;
                $fileName = file->name() '_' time() . '.' . $file->extension();

                if ($path = $file->storeAs('...', $fileName, 's3') && $file->isValid()) {
                    $this->attach($type);

                    return response()->success('File sucessfully uploaded: ' . $path);
                }

                throw new Exception('File was\'nt uploaded!');
            }

            throw new Exception('Request has\'nt got any file!');
        } catch (Exception $e) { // in App\Exceptions\Handler's render() method, add your own exception before parent's rendering
            return response()->error($e->getMessage());
        }
    }

    public function attach($type = '')
    {
        if (in_array($type, $this->attachTypes)) {
            $modelName = $this->attachTypes[$type];
            // your db method with exceptions
        }
    }

}
