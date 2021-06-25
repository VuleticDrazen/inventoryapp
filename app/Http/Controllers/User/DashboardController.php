<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Ticket;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {

        $documents = Document::query()
            ->whereHas('user')
            ->whereHas('items')
            ->get();
        $tickets = Ticket::query()->open();
        return view('user_dashboard', compact(['documents']));
    }
}
