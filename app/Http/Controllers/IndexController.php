<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
class IndexController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //For Index Page
    public function index()
    {
        return view('index');
    }





}
?>
