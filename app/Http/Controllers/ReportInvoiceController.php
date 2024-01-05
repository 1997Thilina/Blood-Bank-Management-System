<?php

namespace App\Http\Controllers;

use App\Models\BloodStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReportInvoiceController extends Controller
{
    public function generateBloodReport(){

        $bloodStock_details = BloodStock::all();
        $pdf = App::make('dompdf.wrapper');
        
        $pdf->loadView('admin.printBloodStockTemplate',compact('bloodStock_details'))->setPaper('a4', 'portrait');
        $pdf->setOptions(['margin-top' => 0, 'margin-right' => 0, 'margin-bottom' => 0, 'margin-left' => 0]);
        // Pdf::loadHTML($html)->setPaper('a3', 'portrait')->setWarnings(false)->save('myfile.pdf')
        return $pdf->stream();
    }
    
}
