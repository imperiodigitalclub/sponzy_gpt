<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem de Validação
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de linguagem contêm as mensagens de erro padrão usadas pela
    | classe validadora. Algumas dessas regras têm várias versões, como
    | as regras de tamanho. Sinta-se à vontade para ajustar cada uma dessas mensagens aqui.
    |
    */

    'accepted'             => 'O :attribute deve ser aceito.',
    'active_url'           => 'O :attribute não é uma URL válida.',
    'after'                => 'O :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O :attribute só pode conter letras.',
    'alpha_dash'           => 'O :attribute só pode conter letras, números e traços.',
    'ascii_only'           => 'O :attribute só pode conter letras, números e traços.',
    'alpha_num'            => 'O :attribute só pode conter letras e números.',
    'array'                => 'O :attribute deve ser um array.',
    'before'               => 'O :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve ter entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não coincide.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não corresponde ao formato :format.',
    'different'            => 'O :attribute e :other devem ser diferentes.',
    'digits'               => 'O :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute tem dimensões de imagem inválidas (:min_width x :min_height px).',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ter um valor.',
    'gt'                   => [
        'numeric' => 'O :attribute deve ser maior que :value.',
        'file'    => 'O :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O :attribute deve ser maior que :value caracteres.',
        'array'   => 'O :attribute deve ter mais de :value itens.',
    ],
    'gte'                  => [
        'numeric' => 'O :attribute deve ser maior ou igual a :value.',
        'file'    => 'O :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O :attribute deve ser maior ou igual a :value caracteres.',
        'array'   => 'O :attribute deve ter :value itens ou mais.',
    ],
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O :attribute deve ser um número inteiro.',
    'ip'                   => 'O :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O :attribute deve ser uma string JSON válida.',
    'lt'                   => [
        'numeric' => 'O :attribute deve ser menor que :value.',
        'file'    => 'O :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O :attribute deve ser menor que :value caracteres.',
        'array'   => 'O :attribute deve ter menos de :value itens.',
    ],
    'lte'                  => [
        'numeric' => 'O :attribute deve ser menor ou igual a :value.',
        'file'    => 'O :attribute deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O :attribute deve ser menor ou igual a :value caracteres.',
        'array'   => 'O :attribute não deve ter mais de :value itens.',
    ],
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O :attribute não pode ser maior que :max caracteres.',
        'array'   => 'O :attribute não pode ter mais de :max itens.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O :attribute deve ser pelo menos :min.',
        'file'    => 'O :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O :attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'not_regex'            => 'O formato do :attribute é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato do :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório, a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum de :values está presente.',
    'same'                 => 'O :attribute e :other devem coincidir.',
    'size'                 => [
        'numeric' => 'O :attribute deve ter :size.',
        'file'    => 'O :attribute deve ter :size kilobytes.',
        'string'  => 'O :attribute deve ter :size caracteres.',
        'array'   => 'O :attribute deve conter :size itens.',
    ],
    'string'               => 'O :attribute deve ser uma string.',
    'timezone'             => 'O :attribute deve ser uma zona válida.',
    'unique'               => 'O :attribute já foi tomado.',
    'uploaded'             => 'O :attribute falhou ao carregar.',
    'url'                  => 'O formato de :attribute é inválido.',
    'account_not_confirmed' => 'Sua conta não está confirmada, por favor, verifique seu e-mail',
    'user_suspended'        => 'Sua conta foi suspensa, entre em contato se isso for um erro',
    'letters'              => 'O :attribute deve conter pelo menos uma letra ou número',
    'video_url'            => 'URL inválida, apenas suportamos Youtube e Vimeo.',
    'update_max_length'    => 'A postagem não pode ser maior que :max caracteres.',
    'update_min_length'    => 'A postagem deve ter pelo menos :min caracteres.',
    'video_url_required'   => 'O campo de URL do vídeo é obrigatório quando o conteúdo em destaque é um vídeo.',

    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem de Validação Personalizada
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar mensagens de validação personalizadas para atributos usando a
    | convenção "attribute.rule" para nomear as linhas. Isso torna rápido especificar
    | uma linha de linguagem personalizada específica para uma determinada regra de atributo.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'mensagem-personalizada',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos de Validação Personalizados
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de linguagem são usadas para substituir espaços reservados de atributos
    | por algo mais legível, como "Endereço de E-mail" em vez de "email". Isso simplesmente
    | nos ajuda a tornar as mensagens um pouco mais limpas.
    |
    */

    'attributes' => [
        'agree_gdpr' => 'caixa Eu concordo com o processamento de dados pessoais',
    'agree_terms' => 'caixa Eu concordo com os Termos e Condições',
    'agree_terms_privacy' => 'caixa Eu concordo com os Termos e Condições e a Política de Privacidade',
    'full_name' => 'Nome Completo',
    'name' => 'Nome',
    'username'  => 'Nome de Usuário',
    'username_email' => 'Nome de Usuário ou Email',
    'email'     => 'Email',
    'password'  => 'Senha',
    'password_confirmation' => 'Confirmação de Senha',
    'website'   => 'Website',
    'location' => 'Localização',
    'countries_id' => 'País',
    'twitter'   => 'Twitter',
    'facebook'   => 'Facebook',
    'google'   => 'Google',
    'instagram'   => 'Instagram',
    'comment' => 'Comentário',
    'title' => 'Título',
    'description' => 'Descrição',
    'old_password' => 'Senha Antiga',
    'new_password' => 'Nova Senha',
    'email_paypal' => 'Email PayPal',
    'email_paypal_confirmation' => 'Confirmação do Email PayPal',
    'bank_details' => 'Dados Bancários',
    'video_url' => 'URL do Vídeo',
    'categories_id' => 'Categoria',
    'story' => 'História',
    'image' => 'Imagem',
    'avatar' => 'Avatar',
    'message' => 'Mensagem',
    'profession' => 'Profissão',
    'thumbnail' => 'Miniatura',
    'address' => 'Endereço',
    'city' => 'Cidade',
    'zip' => 'CEP',
    'payment_gateway' => 'Gateway de Pagamento',
    'payment_gateway_tip' => 'Gateway de Pagamento',
    'MAIL_FROM_ADDRESS' => 'Email no-reply',
    'FILESYSTEM_DRIVER' => 'Disco',
    'price' => 'Preço',
    'amount' => 'Quantia',
    'birthdate' => 'Data de Nascimento',
    'navbar_background_color' => 'Cor de fundo da Barra de Navegação',
    'navbar_text_color' => 'Cor do texto da Barra de Navegação',
    'footer_background_color' => 'Cor de fundo do Rodapé',
    'footer_text_color' => 'Cor do texto do Rodapé',

    'AWS_ACCESS_KEY_ID' => 'Chave Amazon', // Não é necessário editar
    'AWS_SECRET_ACCESS_KEY' => 'Segredo Amazon', // Não é necessário editar
    'AWS_DEFAULT_REGION' => 'Região Amazon', // Não é necessário editar
    'AWS_BUCKET' => 'Bucket Amazon', // Não é necessário editar

    'DOS_ACCESS_KEY_ID' => 'Chave DigitalOcean', // Não é necessário editar
    'DOS_SECRET_ACCESS_KEY' => 'Segredo DigitalOcean', // Não é necessário editar
    'DOS_DEFAULT_REGION' => 'Região DigitalOcean', // Não é necessário editar
    'DOS_BUCKET' => 'Bucket DigitalOcean', // Não é necessário editar

    'WAS_ACCESS_KEY_ID' => 'Chave Wasabi', // Não é necessário editar
    'WAS_SECRET_ACCESS_KEY' => 'Segredo Wasabi', // Não é necessário editar
    'WAS_DEFAULT_REGION' => 'Região Wasabi', // Não é necessário editar
    'WAS_BUCKET' => 'Bucket Wasabi', // Não é necessário editar

    //===== v2.0
    'BACKBLAZE_ACCOUNT_ID' => 'ID da Conta Backblaze', // Não é necessário editar
    'BACKBLAZE_APP_KEY' => 'Chave Mestre do Aplicativo Backblaze', // Não é necessário editar
    'BACKBLAZE_BUCKET' => 'Nome do Bucket Backblaze', // Não é necessário editar
    'BACKBLAZE_BUCKET_REGION' => 'Região do Bucket Backblaze', // Não é necessário editar
    'BACKBLAZE_BUCKET_ID' => 'Endpoint do Bucket Backblaze', // Não é necessário editar

    'VULTR_ACCESS_KEY' => 'Chave Vultr', // Não é necessário editar
    'VULTR_SECRET_KEY' => 'Segredo Vultr', // Não é necessário editar
    'VULTR_REGION' => 'Região Vultr', // Não é necessário editar
    'VULTR_BUCKET' => 'Bucket Vultr', // Não é necessário editar
],

];
