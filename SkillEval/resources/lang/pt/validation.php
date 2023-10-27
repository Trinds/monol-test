<?php

return [

/*
|--------------------------------------------------------------------------
| Linhas de Idioma de Validação
|--------------------------------------------------------------------------
|
| As linhas de idioma a seguir contêm as mensagens de erro padrão usadas pela
| classe de validação. Algumas dessas regras têm várias versões, como
| as regras de tamanho. Sinta-se à vontade para ajustar cada uma dessas mensagens aqui.
|
*/

'accepted' => 'O :attribute deve ser aceite.',
'active_url' => 'O :attribute não é um URL válido.',
'after' => 'O :attribute deve ser uma data posterior a :date.',
'after_or_equal' => 'O :attribute deve ser uma data posterior ou igual a :date.',
'alpha' => 'O :attribute deve conter apenas letras.',
'alpha_dash' => 'O :attribute pode conter apenas letras, números, traços e sublinhados.',
'alpha_num' => 'O :attribute pode conter apenas letras e números.',
'array' => 'O :attribute deve ser um array.',
'before' => 'O :attribute deve ser uma data anterior a :date.',
'before_or_equal' => 'O :attribute deve ser uma data anterior ou igual a :date.',
'between' => [
    'numeric' => 'O :attribute deve estar entre :min e :max.',
    'file' => 'O :attribute deve ter entre :min e :max kilobytes.',
    'string' => 'O :attribute deve ter entre :min e :max caracteres.',
    'array' => 'O :attribute deve ter entre :min e :max itens.',
],
'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
'confirmed' => 'A confirmação do :attribute não coincide.',
'date' => 'O :attribute não é uma data válida.',
'date_equals' => 'O :attribute deve ser uma data igual a :date.',
'date_format' => 'O :attribute não corresponde ao formato :format.',
'different' => 'O :attribute e :other devem ser diferentes.',
'digits' => 'O :attribute deve ter :digits dígitos.',
'digits_between' => 'O :attribute deve ter entre :min e :max dígitos.',
'dimensions' => 'O :attribute tem dimensões de imagem inválidas.',
'distinct' => 'O campo :attribute tem um valor duplicado.',
'email' => 'O :attribute deve ser um endereço de email válido.',
'ends_with' => 'O :attribute deve terminar com um dos seguintes: :values.',
'exists' => 'O :attribute selecionado é inválido.',
'file' => 'O :attribute deve ser um ficheiro.',
'filled' => 'O campo :attribute deve ter um valor.',
'gt' => [
    'numeric' => 'O :attribute deve ser maior do que :value.',
    'file' => 'O :attribute deve ter mais de :value kilobytes.',
    'string' => 'O :attribute deve ter mais de :value caracteres.',
    'array' => 'O :attribute deve ter mais de :value itens.',
],
'gte' => [
    'numeric' => 'O :attribute deve ser maior ou igual a :value.',
    'file' => 'O :attribute deve ter mais ou igual a :value kilobytes.',
    'string' => 'O :attribute deve ter mais ou igual a :value caracteres.',
    'array' => 'O :attribute deve ter :value itens ou mais.',
],
'image' => 'O :attribute deve ser uma imagem.',
'in' => 'O :attribute selecionado é inválido.',
'in_array' => 'O campo :attribute não existe em :other.',
'integer' => 'O :attribute deve ser um número inteiro.',
'ip' => 'O :attribute deve ser um endereço IP válido.',
'ipv4' => 'O :attribute deve ser um endereço IPv4 válido.',
'ipv6' => 'O :attribute deve ser um endereço IPv6 válido.',
'json' => 'O :attribute deve ser uma string JSON válida.',
'lt' => [
    'numeric' => 'O :attribute deve ser menor do que :value.',
    'file' => 'O :attribute deve ter menos de :value kilobytes.',
    'string' => 'O :attribute deve ter menos de :value caracteres.',
    'array' => 'O :attribute deve ter menos de :value itens.',
],
'lte' => [
    'numeric' => 'O :attribute deve ser menor ou igual a :value.',
    'file' => 'O :attribute deve ter menos ou igual a :value kilobytes.',
    'string' => 'O :attribute deve ter menos ou igual a :value caracteres.',
    'array' => 'O :attribute não deve ter mais do que :value itens.',
],
'max' => [
    'numeric' => 'O :attribute não pode ser maior do que :max.',
    'file' => 'O :attribute não pode ser maior do que :max kilobytes.',
    'string' => 'O :attribute não pode exceder os :max caracteres.',
    'array' => 'O :attribute não pode ter mais do que :max itens.',
],
'mimes' => 'O :attribute deve ser um ficheiro do tipo: :values.',
'mimetypes' => 'O :attribute deve ser um ficheiro do tipo: :values.',
'min' => [
    'numeric' => 'O :attribute deve ser pelo menos :min.',
    'file' => 'O :attribute deve ter pelo menos :min kilobytes.',
    'string' => 'O :attribute deve ter pelo menos :min caracteres.',
    'array' => 'O :attribute deve ter pelo menos :min itens.',
],
'not_in' => 'O :attribute selecionado é inválido.',
'not_regex' => 'O formato do :attribute é inválido.',
'numeric' => 'O :attribute deve ser um número.',
'password' => 'A senha está incorreta.',
'present' => 'O campo :attribute deve estar presente.',
'regex' => 'O formato do :attribute é inválido.',
'required' => 'O campo :attribute é obrigatório.',
'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
'required_unless' => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
'same' => 'O :attribute e :other devem ser iguais.',
'size' => [
    'numeric' => 'O :attribute deve ter :size.',
    'file' => 'O :attribute deve ter :size kilobytes.',
    'string' => 'O :attribute deve ter :size caracteres.',
    'array' => 'O :attribute deve conter :size itens.',
],
'starts_with' => 'O :attribute deve começar com um dos seguintes: :values.',
'string' => 'O :attribute deve conter apenas texto.',
'timezone' => 'O :attribute deve ser uma zona válida.',
'unique' => 'O :attribute já foi utilizado.',
'uploaded' => 'O :attribute falhou ao carregar.',
'url' => 'O formato do :attribute é inválido.',
'uuid' => 'O :attribute deve ser um UUID válido.',

/*
|--------------------------------------------------------------------------
| Linhas de Idioma de Validação Personalizadas
|--------------------------------------------------------------------------
|
| Aqui você pode especificar mensagens de validação personalizadas para atributos
| usando a convenção "atributo.regra" para nomear as linhas. Isso torna rápido
| especificar uma linha de idioma personalizada específica para uma regra de atributo.
|
*/
'custom' => [
    
    
    'abbreviation' => [
        'required' => 'A sigla é obrigatória.',
        'string' => 'A sigla deve conter apenas texto.',
        'max' => 'A sigla não pode exceder os :max caracteres.',
        'unique' => 'A sigla introduzida já está em uso.',
        'regex' => 'A sigla deve ter o formato correto.',
        'unique_not_deleted' => 'A sigla introduzida já está em uso.',
    ],
    'edition' => [
        'required' => 'A edição é obrigatória.',
        'string' => 'A edição deve conter apenas texto.',
        'max' => 'A edição não pode exceder os :max caracteres.',
        'regex' => 'A edição deve ter o formato correto.',
    ],
    'course_id' => [
        'required' => 'A escolha do curso é obrigatória.',
    ],
    'start_date' => [
        'required' => 'A data de início é obrigatória.',
        'date' => 'A data de início deve ser uma data válida e com o formato correto.',
        'before' => 'A data de início deve ser anterior à data de conclusão.',
    ],
    'end_date' => [
        'required' => 'A data de conclusão é obrigatória.',
        'date' => 'A data de conclusão deve ser uma data válida e com o formato correto.',
        'after' => 'A data de conclusão deve ser posterior à data de início.',
    ],
    'student_number' => [
        'required' => 'O número de formando é obrigatório.',
        'string' => 'O número de formando deve conter apenas texto.',
        'max' => 'O número de formando não pode exceder os :max caracteres.',
        'unique' => 'O número de formando introduzido já está em uso.',
    ],
    'classroom_id' => [
        'required' => 'A escolha da turma é obrigatória.',
    ],
    'email' => [
        'required' => 'O email é obrigatório.',
        'email' => 'O email deve ser um endereço de email válido.',
        'max' => 'O email não pode exceder os :max caracteres.',
        'unique' => 'O email introduzido já está em uso.',
    ],
    'name' => [
        'required' => 'O nome é obrigatório.',
        'string' => 'O nome deve conter apenas texto.',
        'max' => 'O nome não pode exceder os :max caracteres.',
        'unique' => 'O nome introduzido já está em uso.',
        'unique_not_deleted' => 'O nome introduzido já está em uso.',
    ],
    'birth_date' => [
        'required' => 'A data de nascimento é obrigatória.',
        'date' => 'A data de nascimento deve ser uma data válida e com o formato correto.',
        'before' => 'A data de nascimento deve ser anterior à data atual.',
    ],
    'image' => [
        'image' => 'A imagem deve ser um ficheiro no formato jpeg, png ou gif.',
        'mimes' => 'A imagem deve ser um ficheiro do tipo: :values.',
        'max' => 'A imagem é demasiado grande. Não pode exceder os :max kilobytes.',
    ],
    'password' => [
        'required' => 'A password é obrigatória.',
        'min' => 'A password deve ter pelo menos :min caracteres.',
        'confirmed' => 'A confirmação da password não coincide.',
    ],
    'roles' => [
        'required' => 'A escolha de pelo menos uma função é obrigatória.',
    ],
],

/*
|--------------------------------------------------------------------------
| Atributos de Validação Personalizados
|--------------------------------------------------------------------------
|
| As seguintes linhas de idioma são usadas para trocar nosso espaço reservado de atributo
| por algo mais compreensível, como "Endereço de E-Mail" em vez de "email". Isso ajuda a
| tornar nossa mensagem mais expressiva.
|
*/

'attributes' => [
    'name' => 'nome',
    'abbreviation' => 'sigla',
    'edition' => 'edição',
    'course_id' => 'curso',
    'start_date' => 'data de início',
    'end_date' => 'data de conclusão',
    'student_number' => 'número de formando',
    'classroom_id' => 'turma',
    'email' => 'email',
    'birth_date' => 'data de nascimento',
    'searchParam' => 'parâmetro de pesquisa',
    'filter' => 'filtro',
    'image' => 'imagem',
    'password' => 'password',
    'roles' => 'funções',
    'permissions' => 'permissões',
    'role' => 'função',
    'permission' => 'permissão',
],
];
