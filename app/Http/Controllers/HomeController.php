<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Ticket;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $role = Auth::user()->role_id;

        switch ($role) {
            case '1':
                $categories = EquipmentCategory::query()
                    ->whereHas('available_equipment')
                    ->with('available_equipment')
                    ->get();
                $tickets = Ticket::query()->open();
                return view('admin_dashboard', compact(['categories']));
                break;
            case '2':
                $documents = Document::query()
                    ->where('user_id' , auth()->id())
                    ->get();
                $tickets = Ticket::query()->open();

                return view('user_dashboard', compact(['documents']));


            default:
                return '/';
                break;
        }

    }
}
