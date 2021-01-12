<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function application(Application $application, string $token)
    {
        if (!$token || $application->token !== $token) {
            abort(404);
        }

        $application->token = null;
        $application->save();

        if( $application->is_main_prize) {
            if( $application->is_week_prize) {
                return view('thx/promotion');
            } else {
                return view('thx/week');
            }
        } else {
            if( $application->is_week_prize) {
                return view('thx/main');
            } else {
                return view('thx/mainWeek');
            }
        }
    }
}
