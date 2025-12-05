<?php

namespace App\Http\Controllers\Mailchimp;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('panel.admin.mailchimpNewsletter.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'mailchimp_api_key' => 'required',
            'mailchimp_list_id' => 'required',
        ]);

        setting([
            'mailchimp_register' => $request->has('mailchimp_register') ? 1 : 0,
            'mailchimp_api_key' => $request->get('mailchimp_api_key'),
            'mailchimp_list_id' => $request->get('mailchimp_list_id')
        ])->save();

        return back()->with(['message' => __('Saved Successfully'), 'type' => 'success']);
    }
}
