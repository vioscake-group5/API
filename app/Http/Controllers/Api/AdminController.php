<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order; 
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminController extends Controller {

    public function changeStatus(Request $request, $id)
    {
            $validatedData = $request->validate([
                'status_payment' => ['required', Rule::in(['pending', 'paid', 'failed'])],
                'status_order' => ['required', Rule::in(['pending', 'processing', 'completed', 'cancelled'])],
            ]);

            $order = Order::findOrFail($id);
            $order->update($validatedData);

            return response()->json(['message' => 'Order updated successfully'], 200);
        }


    public function reporting(Request $request, $pdf)
    {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->startDate)->toDateString();
        $endDate = Carbon::createFromFormat('d-m-Y', $request->endDate)->toDateString();

        $reportData = DB::table('cakes')
        ->select('name as nama_pelanggan', 'email as email_pelanggan', 'nama_kue', 'deskripsi', 'harga', 'ukuran', 'topping', 'request_text', 'request_image', 'status_payment', 'status_order')
        ->join('images', 'cakes.id', '=', 'images.cake_id')
        ->join('details', 'images.id', '=', 'details.images_id')
        ->join('orders', 'details.id', '=', 'orders.id_detail')
        ->join('users', 'users.id', '=', 'orders.id_user')
        ->whereBetween('orders.created_at', [$startDate, $endDate])
        ->get();

        if ($pdf == 'pdf') {
            $html = '<html><head></head><body>';
            $html .= '<h1>Report Data</h1>';
            $html .= '<table border="1">';
            $html .= '<tr>';
            $html .= '<th>Nama Pelanggan</th>';
            $html .= '<th>Email Pelanggan</th>';
            $html .= '<th>Nama Kue</th>';
            $html .= '<th>Deskripsi</th>';
            $html .= '<th>Harga</th>';
            $html .= '<th>Ukuran</th>';
            $html .= '<th>Topping</th>';
            $html .= '<th>Request Text</th>';
            $html .= '<th>Request Image</th>';
            $html .= '<th>Status Payment</th>';
            $html .= '<th>Status Order</th>';
            $html .= '</tr>';

            foreach ($reportData as $data) {
                $html .= '<tr>';
                $html .= '<td>' . $data->nama_pelanggan . '</td>';
                $html .= '<td>' . $data->email_pelanggan . '</td>';
                $html .= '<td>' . $data->nama_kue . '</td>';
                $html .= '<td>' . $data->deskripsi . '</td>';
                $html .= '<td>' . $data->harga . '</td>';
                $html .= '<td>' . $data->ukuran . '</td>';
                $html .= '<td>' . $data->topping . '</td>';
                $html .= '<td>' . $data->request_text . '</td>';
                $html .= '<td>' . $data->request_image . '</td>';
                $html .= '<td>' . $data->status_payment . '</td>';
                $html .= '<td>' . $data->status_order . '</td>';
                $html .= '</tr>';
            }

            $html .= '</table>';
            $html .= '</body></html>';

            $options = new Options();
            $options->set('defaultFont', 'Arial');

            $dompdf = new Dompdf($options);

            $dompdf->loadHtml($html);

            $dompdf->setPaper('A3', 'landscape');
            $dompdf->render();

            $pdfContent = $dompdf->output();

            return response($pdfContent)->header('Content-Type', 'application/pdf');
        }else {
            return response()->json(['data' => $reportData], 200);
        }
    }
}