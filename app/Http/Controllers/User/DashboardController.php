<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Ticket;
use App\Models\Equipment;
use App\Models\DocumentItem;


class DashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {

        $documents = Document::query()
            ->where('user_id' , auth()->id())
            ->get();
        $tickets = Ticket::query()->open();

        return view('user_dashboard', compact(['documents']));
    }
}
