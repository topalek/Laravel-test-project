<?php

namespace App\Services;

use App\Http\Requests\BidRequest;
use App\Mail\NewBidMail;
use App\Models\Bid;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BidRegisterService
{

    public function register(BidRequest $request): void
    {

        $filePath = $this->upload($request['file']??'');

        $bid = Bid::new($request['subject'], $request['message'], $filePath);

        $managers = User::whereRole(User::ROLE_MANAGER)->get();

        Mail::to($managers)->queue(new NewBidMail($bid));
    }

    public function getUser(): User
    {
       return Auth::user();
    }

    public function upload(UploadedFile|string $file = ''): string
    {

        if ($file){
            $path = '/uploads/' . $this->getUser()->id;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $this->makeDirIfNotExist($path);
            if ($file->move(public_path($path), $fileName)) {
                $file = $path . '/' . $fileName;
            }
        }
        return $file;
    }

    private function makeDirIfNotExist($path):void
    {
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), recursive: true);
        }
    }
}
