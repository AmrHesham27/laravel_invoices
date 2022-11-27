<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTax;
use App\Models\Tax;
use Illuminate\Http\Request;
use Exception;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $all_products = Product::paginate(8);
            return view('Invoices.index', [
                'all_products' => $all_products, 
                'error' => null
            ]);
        }
        catch (Exception $e) {
            return view('Invoices.index', [
                'all_products' => [], 
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $this->validate($request,[
                "Name"  => "required|string|min:4|max:60",
                "Price" => "required|numeric|min:0",
                "Quantity" => "required|numeric|min:0",
                "Discount"  => "required|numeric|min:0|max:99",
                "DiscountAmount" => "numeric|min:0",
                "ValueDifference" => "required|numeric|min:0",
                "ItemDiscount"  => "required|numeric|min:0",
            ]);
            $data['Sales'] = 0;
            $data['Net'] = 0;
            $data['TotalTaxableAmount'] = 0;
            $data['TotalNonTaxableAmount'] = 0;
            $data['Total'] = 0;

            Product::create($data);

            return redirect()->back()->with('success', 'Product was added Successfully!');
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function addTaxes_page ($id) {
        return view("Invoices.addTaxes", ['id' => $id]);
    }

    public function addTaxes (Request $request, $id) {
        try {
            $data = $this->validate($request,[
                "1" => "",
                "2" => "",
                "3" => "",
                "4" => "",
                "5" => "",
                "6" => "",
                "7" => "",
                "8" => "",
                "9" => "",
                "10" => "",
                "11" => "",
                "12" => "",
                "13" => "",
                "14" => "",
                "15" => "",
                "16" => "",
                "17" => "",
                "18" => "",
                "19" => "",
                "20" => "",
            ]);

            $product = Product::findOrFail($id);
            $Taxes_ids_Array  = [];

            foreach($data as $Tax=>$index) {
                ProductTax::create([
                    'product_id' => $id,
                    'tax_id' => $Tax
                ]);
                array_push($Taxes_ids_Array, $Tax);
            }

            $Taxes_info = Tax::whereIn('id', $Taxes_ids_Array)->get();

            $this->getInvoice($product, $Taxes_info)->save();

            return redirect("/invoices")
                ->with('success', 'Taxes were added successfully');
        }

        catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json([
                "status" => true,
                "message" => "Product was fetched successfully!",
                "data" => $product
            ], 200);
            return view('Invoices.show', ['product' => $product, 'error' => null]);
        }
        catch (Exception $e) {
            return view('Invoices.show', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('Invoices.edit', ['product' => $product, 'error' => null]);
        }
        catch (Exception $e) {
            return view('Invoices.edit', ['product' => null, 'error' => $e->getMessage()]);
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        try {
            $data = $this->validate($request,[
                "id" => "required|numeric",
                "Name"  => "required|string|min:4|max:60",
                "Price" => "required|numeric|min:0",
                "Quantity" => "required|numeric|min:0",
                "Discount"  => "required|numeric|min:0|max:99",
                "DiscountAmount" => "required|numeric|min:0",
                "ValueDifference" => "required|numeric|min:0",
                "ItemDiscount"  => "required|numeric|min:0",
            ]);

            $new_product = array_slice($data, 1);
            $new_product = Product::findOrFail($data['id'])->update($new_product);

            $TaxArray = $new_product->taxes;
            
            $new_product = $this->getInvoice($new_product, $TaxArray)->save();

            return response()->json([
                "status" => true,
                "message" => "Product was edited successfully!",
                "data" => $new_product
            ], 200);
            return redirect()->back()->with('new_product', $new_product);
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::findOrFail($id)->delete();
            return response()->json([
                "status" => true,
                "message" => "Product was deleted successfully!",
            ], 200);
            return redirect()->back()->with('status', 'done');
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }


    /** Calculate Product functions */
    public function getSales ($Quantity, $Price) {
        return ($Quantity * $Price);
    }
    
    public function getDiscountAmount ($DiscountRate, $DiscountAmount, $Sales) {
        $newDiscountAmount = 0;
        if ($DiscountRate != 0) {
          $newDiscountAmount = floor(($DiscountRate / 100) * $Sales);
        }
        elseif ($DiscountRate == 0 && $DiscountAmount) { 
          $newDiscountAmount = $DiscountAmount;
        }
        return $newDiscountAmount;
    }
    
    public function getNet ($Sales, $DiscountAmount) {
        return ($Sales - $DiscountAmount);
    }
    
    public function getTaxes_from_3_to_20 ($Net, $ItemDiscount, $Taxes_info) {
        $New_Taxes_Info = [];
        foreach($Taxes_info as $tax) {
            $newAmount = 0;
            if(!in_array($tax['id'] ,[1, 2, 3, 4, 6])) {
                $newAmount = ($tax['Percentage'] * $Net) / 100;
                $New_Taxes_Info[$tax['id']] = $tax;
                $New_Taxes_Info[$tax['id']]['Amount'] = $newAmount;
            }
            else {
                if ($tax['id'] == 3) $newAmount = 3000;
                elseif ($tax['id'] == 4) $newAmount = ($Net - $ItemDiscount) * ($tax['Percentage'] / 100);
                elseif ($tax['id'] == 6) $newAmount = 6000;
                $New_Taxes_Info[$tax['id']] = $tax;
                $New_Taxes_Info[$tax['id']]['Amount'] = $newAmount;
            }
        };    
        return $New_Taxes_Info;
    }
    
    public function getTaxes_from_1_to_2 ($New_Taxes_Info, $Net, $ValueDifference, $TotalTaxableAmount) {
        foreach($New_Taxes_Info as $tax_id=>$tax) {
            $DiscountAmount_2 = (
                $Net + 
                $TotalTaxableAmount + 
                $ValueDifference + 
                $New_Taxes_Info[3]['Amount']
            ) * ($New_Taxes_Info[2]['Percentage'] / 100);
            $New_Taxes_Info[2]['Amount'] = $DiscountAmount_2;
    
            $DiscountAmount_1 = (
                $Net + 
                $TotalTaxableAmount + 
                $ValueDifference + 
                $New_Taxes_Info[3]['Amount'] + 
                $New_Taxes_Info[2]['Amount']
            ) * ($New_Taxes_Info[1]['Percentage'] / 100);
            $New_Taxes_Info[1]['Amount'] = $DiscountAmount_1;
    
            
            
        }
        
        return $New_Taxes_Info;
    }
    
    public function getTotalTaxableAmount ($Tax) {
        $TotalTaxableAmount = 0;
        foreach($Tax as $index=>$tax) {
            if ($index >= 5 && $index <= 12) $TotalTaxableAmount += $tax['Amount'];
        }
        return $TotalTaxableAmount;
    }
    
    public function getTotalNonTaxableAmount ($Tax) {
        $TotalNonTaxableAmount = 0;
        foreach($Tax as $tax) {
            if ($tax['id'] <= 20 && $tax['id'] >= 13) $TotalNonTaxableAmount += $tax['Amount'];
        }
        return $TotalNonTaxableAmount;
    }
    
    public function getTotalInvoiceLine (
        $Net, 
        $Tax, 
        $TotalTaxableAmount, 
        $TotalNonTaxableAmount, 
        $ItemDiscount
    ) {
        return (
          $Net +
          $Tax[1]['Amount'] +
          $Tax[2]['Amount'] +
          $Tax[3]['Amount'] +
          $TotalTaxableAmount +
          $TotalNonTaxableAmount -
          $Tax[4]['Amount'] -
          $ItemDiscount
        );
    }
    
    public function getInvoice ($newProduct, $Taxes_info) {
        $Sales = $this->getSales($newProduct['Quantity'], $newProduct['Price']);
    
        $DiscountAmount = $this->getDiscountAmount(
          $newProduct['Discount'],
          $newProduct['DiscountAmount'],
          $Sales
        );
    
        $Net = $this->getNet($Sales, $DiscountAmount);
    
        $Tax = $this->getTaxes_from_3_to_20(
            $Net, 
            $newProduct['ItemDiscount'], 
            $Taxes_info, 
        );
    
        $TotalTaxableAmount = $this->getTotalTaxableAmount($Tax);
    
        $Tax = $this->getTaxes_from_1_to_2(
            $Tax, 
            $Net, 
            $newProduct['ValueDifference'], 
            $TotalTaxableAmount, 
        );
    
        $TotalNonTaxableAmount = $this->getTotalNonTaxableAmount($Tax);
    
        $TotalInvoiceLine = $this->getTotalInvoiceLine(
          $Net,
          $Tax,
          $TotalTaxableAmount,
          $TotalNonTaxableAmount,
          $newProduct['ItemDiscount'],
        );
    
        $newProduct['Sales'] = $Sales;
        $newProduct['Net'] = $Net;
        $newProduct['TotalTaxableAmount'] = $TotalTaxableAmount;
        $newProduct['TotalNonTaxableAmount'] = $TotalNonTaxableAmount;
        $newProduct['Total'] = $TotalInvoiceLine;
        $newProduct['DiscountAmount'] = $DiscountAmount;
    
        return $newProduct;
      }
}
