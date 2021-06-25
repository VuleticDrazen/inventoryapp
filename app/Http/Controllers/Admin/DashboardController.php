<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquipmentCategory;
use App\Models\Ticket;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {

        $categories = EquipmentCategory::query()
            ->whereHas('available_equipment')
            ->with('available_equipment')
            ->get();
        $tickets = Ticket::query()->open();
        return view('admin_dashboard', compact(['categories']));
    }
}
