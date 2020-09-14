<?php

namespace App\Http\Controllers;

use App\Library\Master;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Item;
use App\Notifications\NewInvoice;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display a filtered listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $date_range = json_decode($request->date_range);

        $invoices = Invoice::with(['items', 'currency'])
            ->email($request->email)
            ->dateFrom($date_range->from ?? null)
            ->dateTo($date_range->to ?? null)
            ->status($request->status)
            ->orderBy('created_at', 'desc');

        if ($request->export)
            $invoices = $invoices->get();
        else
            $invoices = $invoices->paginate($request->per_page);

        $this->transformInvoice($invoices);

        return Master::successResponse('Fetched successfully', $invoices);
    }

    private function transformInvoice($invoices)
    {
        $invoices->transform(function ($invoice, $key) {
            $total_amt = 0;

            $invoice->items->transform(function ($item, $key) use (&$total_amt) {
                $item->total = ($item->quantity * $item->unit_price);
                $total_amt += $item->total;
                return $item;
            });

            $total_amt += ($invoice->shipping_fee ?? 0) + ($invoice->discount ?? 0) + ($invoice->tax ?? 0);

            $invoice->total_amt = $this->to2dp($total_amt);;
            return $invoice;
        });
    }

    private function to2dp($number)
    {
        return number_format((float)$number, 2, '.', ',');
    }

    public function fetchInvoice($id)
    {
        $invoice = $this->_fetchInvoice($id);

        if ($invoice) {
            return Master::successResponse('Fetched successfully', $invoice);
        }

        return Master::failureResponse('Invoice not found');

    }

    public function _fetchInvoice($id, $flatten = true)
    {
        $invoice = Invoice::with(['items', 'currency', 'user'])
            ->id($id)
            ->get();

        if ($invoice) {

            $this->transformInvoice($invoice);

            if ($flatten) {
                $invoice = Arr::collapse($invoice->toArray());
            }

            return $invoice;
        }
        return null;
    }

    public function editInvoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_email' => 'bail|required|email',
            'due_date' => 'bail|required|date',
            'currency' => 'bail|required|exists:currencies,iso',
            'cc_emails' => 'bail|nullable|string',
            'acc_name' => 'bail|required|string',
            'bank' => 'bail|required|string',
            'acc_num' => 'bail|required|string',
            'notes' => 'bail|nullable|string',
            'shipping_fee' => 'bail|nullable|numeric',
            'discount' => 'bail|nullable|numeric',
            'tax' => 'bail|nullable|numeric',
            'items' => 'bail|array',
            'items.*.title' => 'bail|required|string',
            'items.*.quantity' => 'bail|required|integer',
            'items.*.unit_price' => 'bail|required|numeric',
            '_send' => 'bail|nullable|boolean'
        ]);

        if ($validator->fails()) {
            return Master::validationResponse($validator);
        }

        try {
            DB::beginTransaction();

            $invoice = Invoice::find($request->id);
            if ($invoice)
                $invoice = $invoice->load('items');
            else $invoice = new Invoice;

            $invoice->ref = (time() . Auth::id()) ?? $invoice->ref;
            $invoice->currency_id = Currency::iso($request->currency)->first()->id ?? $invoice->currency_id;
            $invoice->to_email = $request->to_email ?? $invoice->to_email;
            $invoice->cc_emails = $request->cc_emails ?? $invoice->cc_emails;
            $invoice->notes = $request->notes ?? $invoice->notes;
            $invoice->status = $invoice->status == 'draft' || $invoice->status == null ?
                ($request->_send == 'true' ? 'issued' : 'draft') :
                $invoice->status;
            $invoice->issued_at = $request->_send == 'true' ? now()->format('c') : null;
            $invoice->due_date = Carbon::parse($request->due_date)->format('c') ?? $invoice->due_date;
            $invoice->created_at = now()->format('c') ?? $invoice->created_at;
            $invoice->acc_name = $request->acc_name ?? $invoice->acc_name;
            $invoice->bank = $request->bank ?? $invoice->bank;
            $invoice->acc_num = $request->acc_num ?? $invoice->acc_num;
            $invoice->shipping_fee = $request->shipping_fee ?? $invoice->shipping_fee;
            $invoice->discount = $request->discount ?? $invoice->discount;
            $invoice->tax = $request->tax ?? $invoice->tax;
            $invoice->user_id = $request->user_id ?? Auth::id();

            $invoice->save();

            foreach ($request->items as $key => $item) {
                Item::updateOrCreate(
                    ['id' => $item['id'] ?? -1],
                    [
                        'item' => $item['title'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'invoice_id' => $invoice['id'],
                    ]);
            }

            if ($request->_send == 'true') {
                $this->_sendInvoice($invoice);
            }

            DB::commit();
            $response = [
                'invoice' => $invoice
            ];
            return Master::successResponse('Invoice created successfully', $response);

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Edit Invoice');
            }
            return Master::failureResponse();
        }


    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::find($id);

        try {
            DB::beginTransaction();

            $invoice->delete();

            DB::commit();
            return Master::successResponse('Invoice deleted successfully');

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Delete Invoice');
            }
            return Master::failureResponse('Deletion failed');
        }


    }

    public function markAsPaid($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return Master::failureResponse('Invoice not found');
        }

        try {
            DB::beginTransaction();

            $invoice->status = 'paid';
            $invoice->paid_at = now()->format('c');
            $invoice->save();

            DB::commit();
            $response = [
                'invoice' => $this->_fetchInvoice($id)
            ];
            return Master::successResponse('Invoice marked as paid', $response);

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Mark as Paid');
            }
            return Master::failureResponse();
        }


    }

    public function downloadInvoice($id)
    {
        $invoice = $this->_fetchInvoice($id, false)[0];

        if (!$invoice) {
            return Master::failureResponse('Invoice not found');
        }

        try {
            $name = $this->_generatePDF($invoice);

            $response = [
                'file' => $name
            ];
            return Master::successResponse('PDF generated successfully', $response);

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Generate PDF');
            }
            return Master::failureResponse();
        }
    }

    public function _generatePDF($invoice)
    {
        $name = "$invoice->ref.pdf";
        $pdf = PDF::loadView('pdf.invoice', ['invoice' => $invoice]);
        $pdf->save(public_path("invoices/$name"));
        return $name;
    }

    public function _sendInvoice($invoice)
    {
        if (!File::exists(public_path("invoices/$invoice->ref.pdf"))) {
            $this->_generatePDF($invoice);
        }
        Notification::route('mail', $invoice->to_email)
            ->notify(new NewInvoice($invoice, $invoice->status == 'issued'));

        if ($invoice->cc_emails) {
            $cc_emails = explode(',', $invoice->cc_emails);

            foreach ($cc_emails as $email) {
                Notification::route('mail', trim($email))
                    ->notify(new NewInvoice($invoice, $invoice->status == 'issued'));
            }
        }
    }

    public function sendInvoice($id)
    {
        $invoice = $this->_fetchInvoice($id, false)[0];

        if (!$invoice) {
            return Master::failureResponse('Invoice not found');
        }

        try {

            DB::beginTransaction();

            $this->_sendInvoice($invoice);

            if ($invoice->status == 'draft') {
                $total_amt = $invoice->total_amt;
                unset($invoice->total_amt); // Its an accessor so save fails when you remove this
                $invoice->status = 'issued';
                $invoice->issued_at = now()->format('c');
                $invoice->save();
                $invoice->total_amt = $total_amt;
            }

            DB::commit();
            $response = [
                'invoice' => $invoice
            ];
            return Master::successResponse('Invoice sent successfully', $response);

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Send Invoice');
            }
            return Master::failureResponse();
        }
    }


}

