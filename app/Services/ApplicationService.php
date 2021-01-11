<?php

namespace App\Services;

use App\Http\Requests\StoreApplicationRequest;
use App\Mail\ApplicationMail;
use App\Models\Application;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApplicationService
{
    /**
     * @param array $data
     * @param StoreApplicationRequest $request
     * @return Application
     * @throws Exception
     */
    public function store(array $data, StoreApplicationRequest $request): Application
    {
        DB::beginTransaction();

        try {
            $application = new Application($data);

            if( $request->file('img_receipt') ) {
                $application->img_receipt = $request->file('img_receipt')->store('public/receipts');
            }

            $application->whence_id = $data['whence'];
            $application->token = Str::random(32);

            if( $data['main_prize'] ) {
                $application->is_main_prize = true;
                if( $request->file('competition_audio') ) {
                    $application->competition_audio = $request->file('competition_audio')->store('public/audios');
                }
            }

            if( $data['week_prize'] ) {
                $application->is_week_prize = true;

            }

            $params = $request->all();

            $application->save();

            DB::commit();

            return $application;
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception('Nie można zapisać zgłoszenia');
        }
    }

    /**
     * @param string $email
     * @param array $data
     * @return void
     */
    public function sendMail(string $email, array $data): void
    {
        Mail::to($email)->send(new ApplicationMail($data, 'emails.application.html', 'emails.application.text'));
    }
}
