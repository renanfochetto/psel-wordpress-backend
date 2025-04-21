<?php
// Enfileira os estilos do tema e define a URL do tema como variável CSS global
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/style.css');
    wp_add_inline_style('theme-style', ':root { --theme-url: "' . get_template_directory_uri() . '"; }');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Cria o Custom Post Type (CPT) "form_data"
function create_custom_post_type() {
    register_post_type('form_data', array(
        'labels' => array(
            'name' => __('Formulários'),
            'singular_name' => __('Formulário'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'show_in_rest' => true, // Permite acesso via REST API
    ));
}
add_action('init', 'create_custom_post_type');

// Trata diferentes formatos de retorno de imagem do ACF
function parse_acf_image($field_value) {
    if (is_numeric($field_value)) {
        return wp_get_attachment_image_url($field_value, 'full');
    } elseif (is_array($field_value) && isset($field_value['url'])) {
        return $field_value['url'];
    } elseif (is_string($field_value) && filter_var($field_value, FILTER_VALIDATE_URL)) {
        return $field_value;
    }
    return null;
}

// Registra endpoint customizado da REST API para retornar dados do header
function register_custom_header_nav_endpoint() {
    register_rest_route('custom/v1', '/header-nav', array(
        'methods'  => 'GET',
        'callback' => 'get_header_nav_data',
    ));
}
add_action('rest_api_init', 'register_custom_header_nav_endpoint');

// Callback do endpoint /custom/v1/header-nav
function get_header_nav_data() {
    $page = get_page_by_path('inicial');

    if (!$page) {
        return new WP_Error('not_found', 'Página não encontrada', array('status' => 404));
    }

    $acf_fields = get_fields($page->ID);

    if (!$acf_fields) {
        return array(
            'error' => 'Nenhum campo ACF retornado para a página.',
            'page_id' => $page->ID,
            'page_title' => get_the_title($page),
        );
    }

    return array(
        'id' => $page->ID,
        'title' => get_the_title($page),
        'content' => apply_filters('the_content', $page->post_content),
        'acf' => array(
            'headertitle'        => $acf_fields['headertitle'] ?? '',
            'headerdescription'  => $acf_fields['headerdescription'] ?? '',
            'backgroundimage_url'=> parse_acf_image($acf_fields['backgroundimage'] ?? null),
            'scrollimage_url'    => parse_acf_image($acf_fields['scrollimage'] ?? null),
        ),
    );
}

// Registra endpoint para submissão de formulários
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/submit-form', array(
        'methods'             => 'POST',
        'callback'            => 'handle_form_submission',
        'permission_callback' => '__return_true', // Permite envio sem autenticação
    ));
});

// Callback do endpoint de envio de formulário
function handle_form_submission($request) {
    $params = $request->get_json_params();

    // Sanitização dos dados
    $name       = sanitize_text_field($params['name'] ?? '');
    $email      = sanitize_email($params['email'] ?? '');
    $phone      = sanitize_text_field($params['phone'] ?? '');
    $cpf        = sanitize_text_field($params['cpf'] ?? '');
    $resultado  = intval($params['resultado'] ?? 0);

    // Validação
    if (!$name || !$email || !$phone || !$cpf) {
        return new WP_Error('missing_fields', 'Todos os campos são obrigatórios.', ['status' => 400]);
    }

    // Cria o post no CPT "form_data"
    $post_id = wp_insert_post(array(
        'post_type'   => 'form_data',
        'post_title'  => 'Envio de ' . $name,
        'post_status' => 'publish',
        'meta_input'  => array(
            'nome'      => $name,
            'email'     => $email,
            'telefone'  => $phone,
            'cpf'       => $cpf,
            'resultado' => $resultado,
        ),
    ));

    if (is_wp_error($post_id)) {
        return new WP_Error('create_failed', 'Falha ao salvar os dados.', ['status' => 500]);
    }

    return array(
        'success' => true,
        'message' => 'Dados enviados com sucesso.',
        'post_id' => $post_id,
    );
}

// Adiciona os campos ACF no retorno da REST API para o CPT "form_data"
function show_acf_fields_in_rest($data, $post, $context) {
    if ($post->post_type === 'form_data') {
        $acf_fields = get_fields($post->ID);
        if ($acf_fields) {
            $data->data['acf'] = $acf_fields;
        }
    }
    return $data;
}
add_filter('rest_prepare_form_data', 'show_acf_fields_in_rest', 10, 3);
?>
