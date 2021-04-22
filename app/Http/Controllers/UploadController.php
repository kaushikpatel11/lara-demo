<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MediaUpload;
use Auth;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Validator;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * @group  Media Upload
 *
 */

class UploadController extends Controller {
  /**
   * @response {
   * "status": "SUCCESS",
   * "server_message": "MEDIA_UPLOADED",
   * "user_message": "Your media has been uploaded."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function uploadImage(Request $request) {        
    $server = (rand(1, 99999999) % 4) + 1;
    $key = 'media';
    $userId = Auth::User()->id;
    $validator = Validator::make($request->all(), [
      'media' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);
    if ($validator->fails()) {
      return response()->formatted(405, "NO_MEDIA_UPLOADED", "upload", $validator->errors(), "error");
    }
    $filename = str_replace(' ', '-', $_FILES[$key]['name']);
    if (Storage::disk('s3')->exists($filename)) {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $file = basename($filename, "." . $ext);
      $filename = 'user' . $userId . '-' . time() . '.' . $ext;
    }

    $path = $request->file($key);

    if(isset($request['image_segment_name']) && $request['image_segment_name']=='header'){         
        
        $resizedImg = Image::make($path)->resize(1216, 500)->encode('png');

        if (Storage::disk('s3')->put($filename, $resizedImg, 'public')) {
          $visibility = Storage::getVisibility($filename);
          Storage::setVisibility($filename, 'public');

          $thumbpath = $request->file($key);
          $resizedImg = Image::make($thumbpath)->resize(400, 400)->encode('png');
          $thumbnail = Storage::disk('s3')->put('thumbnails/' . $filename, $resizedImg, 'public');

          $media = new MediaUpload;
          $media->server = $server;
          $media->path = $filename;
          $media->createdBy()->associate(Auth::id());
          $media->save();

        return response()->formatted(200, "MEDIA_UPLOADED", "upload", $media, "item");
      } else {
        return response()->formatted(500, "NO_MEDIA_UPLOADED", "upload", "failed to upload", "error");
      }
      
    }else if (isset($request['image_segment_name']) && $request['image_segment_name']=='profile'){


      $resizedImg = Image::make($path)->resize(500, 500)->encode('png');

        if (Storage::disk('s3')->put($filename, $resizedImg, 'public')) {
          $visibility = Storage::getVisibility($filename);
          Storage::setVisibility($filename, 'public');

          $thumbpath = $request->file($key);
          $resizedImg = Image::make($thumbpath)->resize(400, 400)->encode('png');
          $thumbnail = Storage::disk('s3')->put('thumbnails/' . $filename, $resizedImg, 'public');

          $media = new MediaUpload;
          $media->server = $server;
          $media->path = $filename;
          $media->createdBy()->associate(Auth::id());
          $media->save();

        return response()->formatted(200, "MEDIA_UPLOADED", "upload", $media, "item");
      } else {
        return response()->formatted(500, "NO_MEDIA_UPLOADED", "upload", "failed to upload", "error");
      }

    }else{
    
        if ($tmppath = $request->file($key)->storeAs('', $filename)) {
          $visibility = Storage::getVisibility($filename);
          Storage::setVisibility($filename, 'public');
          $thumbpath = $request->file($key);
          $resizedImg = Image::make($thumbpath)->resize(400, 400)->encode('png');
          $thumbnail = Storage::disk('s3')->put('thumbnails/' . $filename, $resizedImg, 'public');

          $media = new MediaUpload;
          $media->server = $server;
          $media->path = $tmppath;
          $media->createdBy()->associate(Auth::id());
          $media->save();
          return response()->formatted(200, "MEDIA_UPLOADED", "upload", $media, "item");
        } else {
          return response()->formatted(500, "NO_MEDIA_UPLOADED", "upload", "failed to upload", "error");
        }
      }   
  }

  public function uploadFile(Request $request) {
    $server = (rand(1, 99999999) % 4) + 1;
    $key = 'media';
    $userId = Auth::User()->id;
    $validator = Validator::make($request->all(), [
      'media' => 'required|mimes:pdf|max:10000',
    ]);
    if ($validator->fails()) {
      return response()->formatted(405, "NO_FILE_UPLOADED", "upload", $validator->errors(), "error");
    }
    $filename = str_replace(' ', '-', $_FILES[$key]['name']);
    if (Storage::disk('s3')->exists('files/' . $filename)) {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $file = basename($filename, "." . $ext);
      $filename = $file . time() . $userId . '.' . $ext;
    }
    if ($tmppath = $request->file($key)->storeAs('files', $filename)) {
      $visibility = Storage::getVisibility('files/' . $filename);
      Storage::setVisibility('files/' . $filename, 'public');
      $media = new MediaUpload;
      $media->server = $server;
      $media->path = $tmppath;
      $media->createdBy()->associate(Auth::id());
      $media->save();
      $filesObject = [
        "id" => $media->id,
        "url" => $media->url,
      ];
      return response()->formatted(200, "FILE_UPLOADED", "upload", $filesObject, "item");
    } else {
      return response()->formatted(405, "NO_FILE_UPLOADED", "upload", "Failed to upload.", "error");
    }
  }

  public function uploadProductFile(Request $request) {
    $server = (rand(1, 99999999) % 4) + 1;
    $key = 'media';
    $userId = Auth::User()->id;
    $validator = Validator::make($request->all(), [
      'media' => 'required|mimes:jpeg,png,jpg,gif,pdf,docx,txt,doc|max:10000',
    ]);
    if ($validator->fails()) {
      return response()->formatted(405, "NO_FILE_UPLOADED", "upload", $validator->errors(), "error");
    }
    $filename = str_replace(' ', '-', $_FILES[$key]['name']);
    if (Storage::disk('s3')->exists('files/' . $filename)) {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $file = basename($filename, "." . $ext);
      $filename = $file . time() . $userId . '.' . $ext;
    }
    if ($tmppath = $request->file($key)->storeAs('files', $filename)) {
      $visibility = Storage::getVisibility('files/' . $filename);
      Storage::setVisibility('files/' . $filename, 'public');
      $media = new MediaUpload;
      $media->server = $server;
      $media->path = $tmppath;
      $media->createdBy()->associate(Auth::id());
      $media->save();
      $filesObject = [
        "id" => $media->id,
        "url" => $media->url,
      ];
      return response()->formatted(200, "FILE_UPLOADED", "upload", $filesObject, "item");
    } else {
      return response()->formatted(405, "NO_FILE_UPLOADED", "upload", "Failed to upload.", "error");
    }
  }
}
