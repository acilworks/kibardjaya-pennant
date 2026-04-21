<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Handle the incoming request to subscribe to the newsletter.
     */
    public function subscribe(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ];
        $messages = [
            'email.unique' => 'This email is already subscribed to our newsletter.',
            'email.required' => 'Please provide an email address.',
            'email.email' => 'Please provide a valid email address.',
        ];

        // Handle AJAX requests with JSON response
        if ($request->expectsJson()) {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first('email'),
                ], 422);
            }

            NewsletterSubscriber::create([
                'email' => $request->email,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
            ]);
        }

        // Fallback: standard form submission
        $request->validate($rules, $messages);

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('newsletter_success', 'Thank you for subscribing to our newsletter!');
    }
}
