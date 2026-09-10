<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 * 
 * Automatically generated via CLI.
 */
class ProductController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductModel');
    }

    public function index()
    {
        $this->call->view('product/index', [
            'products' => $this->ProductModel->all()
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = $this->product_input();

            if ($product === false) {
                return $this->call->view('product/create', [
                    'error' => 'Product name, price, and quantity are required.'
                ]);
            }

            $this->ProductModel->insert($product);
            return redirect('/products');
        }

        $this->call->view('product/create');
    }

    public function edit($id)
    {
        $id = $this->valid_id($id);
        $product = $id ? $this->ProductModel->find($id) : false;

        if (!$product) {
            return show_404();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->product_input();

            if ($data === false) {
                return $this->call->view('product/edit', [
                    'product' => $product,
                    'error' => 'Product name, price, and quantity are required.'
                ]);
            }

            $this->ProductModel->update($id, $data);
            return redirect('/products');
        }

        $this->call->view('product/edit', ['product' => $product]);
    }

    public function delete($id)
    {
        $id = $this->valid_id($id);

        if (!$id || !$this->ProductModel->find($id)) {
            return show_404();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ProductModel->delete($id);
            return redirect('/products');
        }

        $this->call->view('product/delete', [
            'product' => $this->ProductModel->find($id)
        ]);
    }

    private function product_input()
    {
        $name = trim((string) ($_POST['product_name'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $price = $_POST['price'] ?? '';
        $quantity = $_POST['quantity'] ?? '';

        if ($name === '' || !is_numeric($price) || $price < 0 || filter_var($quantity, FILTER_VALIDATE_INT) === false || $quantity < 0) {
            return false;
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity
        ];
    }

    private function valid_id($id)
    {
        return ctype_digit((string) $id) && (int) $id > 0 ? (int) $id : false;
    }
}