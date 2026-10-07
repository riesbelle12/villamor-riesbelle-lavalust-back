<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cors_headers();
    }

    public function preflight()
    {
        $this->cors_headers();
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        http_response_code(204);
        exit;
    }

    public function login()
    {
        $this->load_api_models();
        $input = $this->json_input();
        $username = $input['username'] ?? null;
        $password = $input['password'] ?? null;

        if (!is_string($username) || !is_string($password) || trim($username) === '' || $password === '') {
            $this->respond(['error' => 'Username and password are required.'], 422);
        }

        $username = trim($username);
        $user = $this->UserModel->find_by('username', $username);
        $active = $user && (int) ($user['is_active'] ?? $user['isactive'] ?? 1) === 1;

        if (!$active || !password_verify($password, (string) ($user['password'] ?? ''))) {
            $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $this->jwt_secret();
        $this->refresh_secret();
        $refresh_token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', time() + (int) config_item('refresh_token_expiration'));
        $token_id = $this->RefreshTokenModel->insert([
            'user_id' => (int) $user['id'],
            'token' => $this->refresh_token_hash($refresh_token),
            'expires_at' => $expires_at,
            'jti' => bin2hex(random_bytes(16)),
        ]);
        if (!$token_id) {
            $this->respond(['error' => 'The session could not be created.'], 500);
        }

        $this->respond([
            'access_token' => $this->create_access_token($user),
            'refresh_token' => $refresh_token,
            'user' => [
                'id' => (int) $user['id'],
                'username' => (string) $user['username'],
            ],
        ]);
    }

    public function refresh()
    {
        $this->load_api_models();
        $input = $this->json_input();
        $refresh_token = trim((string) ($input['refresh_token'] ?? ''));
        if ($refresh_token === '') {
            $this->respond(['error' => 'A refresh token is required.'], 401);
        }

        $this->jwt_secret();
        $this->refresh_secret();
        $stored_token = $this->RefreshTokenModel->find_by(
            'token',
            $this->refresh_token_hash($refresh_token)
        );

        if (!$stored_token || strtotime((string) $stored_token['expires_at']) <= time()) {
            $this->respond(['error' => 'Refresh token is invalid or expired.'], 401);
        }

        $user = $this->UserModel->find((int) $stored_token['user_id']);
        if (!$user || (int) ($user['is_active'] ?? $user['isactive'] ?? 1) !== 1) {
            $this->RefreshTokenModel->delete((int) $stored_token['id']);
            $this->respond(['error' => 'The account is unavailable.'], 401);
        }

        $expires_at = date('Y-m-d H:i:s', time() + (int) config_item('refresh_token_expiration'));
        $this->RefreshTokenModel->update((int) $stored_token['id'], [
            'expires_at' => $expires_at,
        ]);

        $this->respond([
            'tokens' => [
                'access_token' => $this->create_access_token($user),
                'refresh_token' => $refresh_token,
            ],
        ]);
    }

    public function logout()
    {
        $this->load_api_models();
        $input = $this->json_input();
        $refresh_token = trim((string) ($input['refresh_token'] ?? ''));

        if ($refresh_token !== '') {
            $this->refresh_secret();
            $this->RefreshTokenModel->delete_where([
                'token' => $this->refresh_token_hash($refresh_token),
            ]);
        }

        $this->respond(['message' => 'Signed out.']);
    }

    public function products()
    {
        $this->load_api_models();
        $this->authenticated_user();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->respond(['products' => $this->ProductModel->all()]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = $this->product_input($this->json_input());
            if ($product === false) {
                $this->respond(['error' => 'A valid product name, price, and quantity are required.'], 422);
            }

            $id = $this->ProductModel->insert($product);
            if (!$id) {
                $this->respond(['error' => 'The product could not be created.'], 500);
            }

            $this->respond(['product' => $this->ProductModel->find((int) $id)], 201);
        }

        $this->respond(['error' => 'Method not allowed.'], 405);
    }

    public function product($id)
    {
        $this->load_api_models();
        $this->authenticated_user();

        if (!ctype_digit((string) $id) || (int) $id < 1) {
            $this->respond(['error' => 'Product not found.'], 404);
        }

        $id = (int) $id;
        $product = $this->ProductModel->find($id);
        if (!$product) {
            $this->respond(['error' => 'Product not found.'], 404);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->respond(['product' => $product]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $updated = $this->product_input($this->json_input());
            if ($updated === false) {
                $this->respond(['error' => 'A valid product name, price, and quantity are required.'], 422);
            }

            $this->ProductModel->update($id, $updated);
            $this->respond(['product' => $this->ProductModel->find($id)]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $this->ProductModel->delete($id);
            $this->respond(['message' => 'Product deleted.']);
        }

        $this->respond(['error' => 'Method not allowed.'], 405);
    }

    private function load_api_models()
    {
        $this->call->database();
        $this->call->model('UserModel');
        $this->call->model('ProductModel');
        $this->call->model('RefreshTokenModel');
    }

    private function authenticated_user()
    {
        $authorization = $_SERVER['HTTP_AUTHORIZATION']
            ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
            ?? '';

        if (!preg_match('/^Bearer\s+(.+)$/i', $authorization, $matches)) {
            $this->respond(['error' => 'Authentication is required.'], 401);
        }

        $claims = $this->verify_access_token($matches[1]);
        if (!$claims) {
            $this->respond(['error' => 'Access token is invalid or expired.'], 401);
        }

        $user = $this->UserModel->find((int) $claims['sub']);
        if (!$user || (int) ($user['is_active'] ?? $user['isactive'] ?? 1) !== 1) {
            $this->respond(['error' => 'The account is unavailable.'], 401);
        }

        return $user;
    }

    private function product_input(array $input)
    {
        $name = $input['product_name'] ?? null;
        $description = $input['description'] ?? '';
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if (
            !is_string($name)
            || !is_string($description)
            || strlen(trim($name)) < 2
            || strlen($name) > 100
            || strlen($description) > 65535
            || !is_numeric($price)
            || (float) $price < 0
            || (float) $price > 99999999.99
            || (!is_int($quantity) && !is_string($quantity))
            || filter_var($quantity, FILTER_VALIDATE_INT) === false
            || (int) $quantity < 0
        ) {
            return false;
        }

        return [
            'product_name' => trim($name),
            'description' => trim($description),
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity,
        ];
    }

    private function json_input()
    {
        $input = json_decode((string) file_get_contents('php://input'), true);
        if (!is_array($input)) {
            $this->respond(['error' => 'A valid JSON request body is required.'], 400);
        }

        return $input;
    }

    private function create_access_token(array $user)
    {
        $now = time();
        $header = $this->base64url_encode(json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256',
        ]));
        $payload = $this->base64url_encode(json_encode([
            'iss' => (string) config_item('jwt_issuer'),
            'aud' => (string) config_item('jwt_audience'),
            'sub' => (int) $user['id'],
            'username' => (string) $user['username'],
            'iat' => $now,
            'exp' => $now + (int) config_item('payload_token_expiration'),
        ]));
        $signing_input = $header . '.' . $payload;
        $signature = hash_hmac('sha256', $signing_input, $this->jwt_secret(), true);

        return $signing_input . '.' . $this->base64url_encode($signature);
    }

    private function verify_access_token($token)
    {
        $parts = explode('.', (string) $token);
        if (count($parts) !== 3) {
            return false;
        }

        $header = json_decode($this->base64url_decode($parts[0]), true);
        $claims = json_decode($this->base64url_decode($parts[1]), true);
        if (!is_array($header) || !is_array($claims) || ($header['alg'] ?? '') !== 'HS256') {
            return false;
        }

        $expected = $this->base64url_encode(hash_hmac(
            'sha256',
            $parts[0] . '.' . $parts[1],
            $this->jwt_secret(),
            true
        ));

        if (
            !hash_equals($expected, $parts[2])
            || (int) ($claims['exp'] ?? 0) <= time()
            || ($claims['iss'] ?? '') !== config_item('jwt_issuer')
            || ($claims['aud'] ?? '') !== config_item('jwt_audience')
            || (int) ($claims['sub'] ?? 0) < 1
        ) {
            return false;
        }

        return $claims;
    }

    private function base64url_encode($value)
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function base64url_decode($value)
    {
        $decoded = base64_decode(strtr($value, '-_', '+/'), true);
        return $decoded === false ? '' : $decoded;
    }

    private function refresh_token_hash($refresh_token)
    {
        return hash_hmac('sha256', $refresh_token, $this->refresh_secret());
    }

    private function jwt_secret()
    {
        $secret = (string) config_item('jwt_secret');
        if ($secret === '') {
            $this->respond(['error' => 'The API JWT_SECRET is not configured.'], 500);
        }

        return $secret;
    }

    private function refresh_secret()
    {
        $secret = (string) config_item('refresh_token_key');
        if ($secret === '') {
            $this->respond(['error' => 'The API REFRESH_TOKEN_KEY is not configured.'], 500);
        }

        return $secret;
    }

    private function cors_headers()
    {
        header('Vary: Origin');
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $allowed_origins = ['https://villamor-riesbelle-crud.onrender.com'];
        $configured_origins = getenv('FRONTEND_ORIGINS');
        if ($configured_origins !== false) {
            $allowed_origins = array_merge(
                $allowed_origins,
                array_map('trim', explode(',', $configured_origins))
            );
        }

        $is_allowed = in_array($origin, $allowed_origins, true);
        if (!$is_allowed && $origin !== '') {
            $host = parse_url($origin, PHP_URL_HOST);
            $is_allowed = $host !== null && in_array($host, ['localhost', '127.0.0.1'], true);
        }

        if ($origin !== '' && $is_allowed) {
            header('Access-Control-Allow-Origin: ' . $origin);
        }
    }

    private function respond(array $body, $status = 200)
    {
        $this->cors_headers();
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($status);
        echo json_encode($body, JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
        exit;
    }
}
