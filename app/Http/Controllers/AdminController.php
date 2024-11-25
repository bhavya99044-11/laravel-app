<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ColorSize;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;
use App\Models\CoupanDiscount;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;
use App\Models\ProductImage;
use App\Models\UserOrder;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $data = [];
        $userId = 1;
        $data['products'] = Product::where('user_id', '=', $userId)->get();
        $data['categories'] = ProductCategory::all();
        $data['colors'] = Color::all();
        $data['sizes'] = Size::all();
        return view('pages.adminPage')->with(['data' => $data]);
    }


    //For Admin site Order Status
    public function adminPanel(Request $request)
    {

        if ($request->ajax()) {
            $data=UserOrder::with( ['orderItems','coupon','user'])->orderBy('created_at','DESC')->get();

            $options=[
                'pending',
                'processing',
                'delivered',
                'cancelled',
                'failed'
            ];
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('order_status', function ($row) use ($options) {
                    $html='<select data-id='.$row->id.' name="status">';
                    foreach($options as $key => $data){
                        if($row->status==$data){
                            $html.= '<option selected value="'.$data.'">'.$data.'</option>';
                        }else{
                            $html.= '<option value="'.$data.'">'.$data.'</option>';
                        }
                    }
                    $html.= '</select>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '  <button type="button" class="btn btn-primary editButton" id="editButton" data-key=' . $row['id'] . ' >Edit</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action','user_name','order_status'])
                ->make(true);
        }
        return view('frontend.admin.admin-panel');
    }

    //Status Update Of Order Panel
    public function statusUpdate(Request $request){
        $order=UserOrder::find($request->id);
        $order->status=$request->status;
        $order->save();
        return response()->json(['success'=>'Status updated successfully']);
    }

    public function AddProduct(Request $request)
    {

        if ($request->file('image')) {
            $imageName = time() . $request->file('image')->getClientOriginalName();
            $imageName = trim(str_replace(' ', '', $imageName));
            $image = $request->file('image');
            $path = $image->move(public_path('images'), $imageName);
        } else {
            $imageName = 'blank_image.jpg';
        }
        try {
            $data = ColorSize::create([
                'color_id' => $request->color,
                'price' => $request->price,
                'size_id' => $request->size,
                'product_id' => $request->products
            ]);
            $data->image()->create([

                'url' => $imageName
            ]);
            $data->Inventory()->create([
                'quantity' => $request->stock,
            ]);
            return response()->json([
                'status' => 200,
                'data' => $request->all()
            ]);
        } catch (\Exception $e) {
            if ($request->file('image')) {
                File::delete($path->getPathname());
            }
            dd($e->getMessage());

        }

    }

    public function NewProduct(Request $request)
    {
        try {
            $userId = 1;
            product::create([
                'product_name' => $request->product_name,
                'product_description' => $request->body,
                'category_id' => $request->category,
                'price' => $request->price,
                'user_id' => $userId
            ]);
            return response()->json([
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400
            ]);
        }
    }

    public function tableData(Request $request)
    {
        $id = $request->productId;
        try {

            $data = Product::with('ColorSize', 'ColorSize.color', 'ColorSize.size', 'ColorSize.inventory', 'ColorSize.image')
                ->where('id', '=', $id)
                ->get();
            $html = '';

            foreach ($data[0]->ColorSize as $index => $row) {
                $image = "images/" . $row->image[0]->url;
                // $path=public_path($image);
                $html .= ' <tr class="tableRow" data-id=' . $row->id . '>
      <th scope="row">' . $row->id . '</th>
      <td class="color" data-id=' . $row->color->id . '>' . $row->color->color . '</td>
      <td class="size" data-id=' . $row->size->id . '>' . $row->size->name . '</td>
      <td class="data">' . $row->inventory[0]->quantity . '</td>
      <td class="image"> <img style="height:50px; width:50px;" src="images/' . $row->image[0]->url . '"</td>
      <td ><i class="fas fa-edit updateData " value=' . $row->id . ' class="" id="updateData" ></i>
       <i class="fas fa-save hide saveInline" value=' . $row->id . '  id="saveInline"></i><i class="fa-solid fa-x hide cancelInline" value=' . $row->id . '  id="cancelInline"></i>
      </td>
      <td><i class="fa fa-trash deleteData" aria-hidden="true" value=' . $row->id . '  id="deleteData"></i></td>

    </tr>';
            }
            return response()->json([
                'status' => 200,
                'data' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function deleteData(Request $request)
    {
        try {
            $data = ColorSize::find($request->deleteId);
            $data->delete();
            return response()->json([
                'status' => 200,
                'data' => 'deleted'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'data' => $e->getMessage()
            ]);
        }

    }

    public function colorSize(Request $request)
    {
        try {
            $colorId = $request->colorId;
            $sizeId = $request->sizeId;
            $color = Color::all();
            $size = Size::all();
            $colorHtml = '';
            $colorHtml .= '<select name="color">';
            foreach ($color as $row) {
                $colorHtml .= '<option value=' . $row->id . ' ' . ($row->id == $colorId ? "selected" : "") . ' >' . $row->color . '</option>';

            }
            $colorHtml .= '</select>';
            $sizeHtml = '<select name="size">';
            foreach ($size as $row) {
                $sizeHtml .= '<option value=' . $row->id . ' ' . ($row->id == $sizeId ? "selected" : "") . '  >' . $row->name . '</option>';
            }
            $sizeHtml .= '</select>';
            return response()->json([
                'status' => 200,
                'sizeHtml' => $sizeHtml,
                'colorHtml' => $colorHtml
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    public function updateData(Request $request)
    {
        try {
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function inlineUpdate(Request $request)
    {
        try {
            $data = ColorSize::find($request->pivotId);
            $data->update([
                'color_id' => $request->colorId,
                'size_id' => $request->sizeId
            ]);
            $data->Inventory()->update([
                'quantity' => $request->stock
            ]);
            return response()->json([
                'status' => 200,
                'data' => 'data updated'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'data' => $e->getMessage()
            ]);
        }
    }

}
