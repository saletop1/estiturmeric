<?php
// app/Http/Controllers/Admin/ProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->orderBy('id','desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image']  = $this->handleImage($request, 'image');
        $data['slug']   = Str::slug($request->name);
        $data['lab_data'] = $this->parseLabData($request);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $this->handleImage($request, 'image');
        }
        $data['lab_data'] = $this->parseLabData($request);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Status produk diperbarui.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'             => 'required|max:200',
            'category'         => 'nullable|max:100',
            'short_desc'       => 'nullable|max:300',
            'description'      => 'nullable',
            'price'            => 'nullable|numeric',
            'price_old'        => 'nullable|numeric',
            'unit'             => 'nullable|max:20',
            'min_order'        => 'nullable|integer',
            'badge'            => 'nullable|max:50',
            'is_active'        => 'boolean',
            'is_featured'      => 'boolean',
            'sort_order'       => 'integer',
            'meta_title'       => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);
    }

    private function handleImage(Request $request, string $field): ?string
    {
        if ($request->hasFile($field)) {
            return $request->file($field)->store('products', 'public');
        }
        return null;
    }

    private function parseLabData(Request $request): ?array
    {
        $keys = $request->input('lab_keys', []);
        $vals = $request->input('lab_values', []);
        if (empty($keys)) return null;
        $data = [];
        foreach ($keys as $i => $k) {
            if (!empty($k)) $data[$k] = $vals[$i] ?? '';
        }
        return $data ?: null;
    }
}
