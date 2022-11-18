<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'դաշտը պետք է ընդունվի',
    'accepted_if' => 'դաշտը պետք է ընդունվի երբ :other հավասար է :value.',
    'active_url' => 'դաշտը վավեր հղում չէ',
    'after' => 'դաշտը պետք է լինի ամսաթիվ :date -ից հետո.',
    'after_or_equal' => 'դաշտը պետք է լինի ամսաթիվ :date -ից հետո կամ հավասար',
    'alpha' => 'դաշտը պետք է պարունակի միայն տառեր.',
    'alpha_dash' => 'դաշտը պետք է պարունակի միայն տառեր, թվեր, գծիկներ և ընդգծումներ.',
    'alpha_num' => 'դաշտը պետք է պարունակի միայն տառեր և թվեր.',
    'array' => 'դաշտը պետք է լինի զանգված.',
    'before' => 'դաշտը պետք է լինի ամսաթիվ մինջև :date.',
    'before_or_equal' => 'դաշտը պետք է լինի ամսաթիվ մինջև :date , կամ հավասար.',
    'between' => [
        'numeric' => 'դաշտը պետք է լինի :min -ից :max -ի միջև.',
        'file' => 'դաշտը պետք է լինի :min և :max կիլոբայթների միջև.',
        'string' => 'դաշտը պետք է լինի :min և :max նիշերի միջև.',
        'array' => 'դաշտը պետք է ունենա :min և :max տարրերի միջև.',
    ],
    'boolean' => 'դաշտը պետք է լինի ճշմարիտ կամ կեղծ.',
    'confirmed' => 'հաստատումը չի համընկնում.',
    'current_password' => 'Գաղտնաբառը սխալ է.',
    'date' => 'դաշտը վավեր ամսաթիվ չէ.',
    'date_equals' => 'դաշտը պետք է լինի :date -ին հավասար ամսաթիվ․',
    'date_format' => 'դաշտը հատկանիշը չի համապատասխանում :format ֆորմատին.',
    'declined' => 'դաշտը պետք է մերժել.',
    'declined_if' => 'դաշտը պետք է մերժվի, երբ  :other -ը :value է.',
    'different' => 'դաշտը և :other պետք է տարբեր լինեն.',
    'digits' => 'դաշտը պետք է լինեն :digits թվեր.',
    'digits_between' => 'դաշտը պետք է լինի :min և :max թվանշանների միջև.',
    'dimensions' => 'դաշտը ունի պատկերի անվավեր չափեր.',
    'distinct' => 'դաշտն ունի կրկնօրինակ արժեք.',
    'email' => 'Դաշտը պետք է վավեր էլ փոստի հասցե լինի.',
    'ends_with' => 'դաշտը պետք է ավարտվի հետևյալներից մեկով :values.',
    'enum' => 'Ընտրված դաշտը անվավեր է.',


    'exists' => 'դաշտը անվավեր է.',
    'file' => 'դաշտը պետք է լինի ֆայլ.',
    'filled' => 'դաշտը պետք է արժեք ունենա.',
    'gt' => [
        'numeric' => 'դաշտը պետք է լինի :value -ից մեծ.',
        'file' => ' դաշտը պետք է լինի :value կիլոբայթից մեծ.',
        'string' => 'դաշտը պետք է լինի :value նիշերից.',
        'array' => 'դաշտը պետք է ունենա ավելի քան :value տարրեր.',
    ],
    'gte' => [
        'numeric' => 'դաշտը պետք է մեծ կամ հավասար լինի :value -ին.',
        'file' => 'դաշտը պետք է մեծ կամ հավասար լինի :value կիլոբայթին.',
        'string' => 'դաշտը պետք է մեծ կամ հավասար լինի :value նիշերին.',
        'array' => 'դաշտը պետք է ունենա :value տարրեր կամ ավելին.',
    ],
    'image' => 'դաշտը պետք է լինի պատկեր.',
    'in' => 'Ընտրված դաշտը անվավեր է.',
    'in_array' => 'դաշտը գոյություն չունի :other -ում.',
    'integer' => 'դաշտը պետք է լինի ամբողջ թիվ.',
    'ip' => 'դաշտը պետք է լինի վավեր IP հասցե.',
    'ipv4' => 'դաշտը պետք է լինի վավեր IPv4 հասցե.',
    'ipv6' => 'դաշտը պետք է լինի վավեր IPv6 հասցե.',
    'json' => 'դաշտը պետք է լինի վավեր JSON տող.',
    'lt' => [
        'numeric' => 'դաշտը պետք է լինի :value -ից փոքր.',
        'file' => 'դաշտը պետք է լինի :value կիլոբայթից պակաս.',
        'string' => 'դաշտը պետք է լինի :value նիշերից պակաս.',
        'array' => 'դաշտը պետք է ունենա  :value -ից պակաս տարրեր.',
    ],
    'lte' => [
        'numeric' => 'դաշտը պետք է լինի փոքր կամ հավասար :value-ին.',
        'file' => 'դաշտը պետք է փոքր կամ հավասար լինի :value կիլոբայթին.',
        'string' => 'դաշտը պետք է լինի փոքր կամ հավասար :value նիշերին.',
        'array' => 'դաշտը չպետք է ունենա ավելի քան :value տարրեր.',
    ],
    'mac_address' => 'դաշտը պետք է լինի վավեր MAC հասցե.',
    'max' => [
        'numeric' => 'դաշտը չպետք է ավելի մեծ լինի, քան :max.',
        'file' => 'դաշտը չպետք է ավելի մեծ լինի, քան :max կիլոբայթին.',
        'string' => 'դաշտը չպետք է ավելի մեծ լինի, քան :max նիշերին.',
        'array' => 'դաշտը չպետք է ունենա ավելի քան :max տարրեր.',
    ],
    'mimes' => 'դաշտը պետք է լինի type: :values տեսակի ֆայլ.',
    'mimetypes' => 'դաշտը պետք է լինի type: :values տեսակի ֆայլ.',
    'min' => [
        'numeric' => 'դաշտը պետք է լինի առնվազն :min.',
        'file' => 'Ֆայլը պետք է լինի առնվազն :min կիլոբայթ.',
        'string' => 'դաշտը պետք է լինի առնվազն :min նիշ.',
        'array' => 'դաշտը պետք է ունենա առնվազն :min տարրեր.',
    ],
    'multiple_of' => 'դաշտը պետք է լինի :value -ի բազմապատիկ.',
    'not_in' => 'Ընտրված դաշտը անվավեր է.',
    'not_regex' => 'ձևաչափն անվավեր է.',
    'numeric' => 'Դաշտը պետք է լինի թիվ.',
    'password' => 'Գաղտնաբառը սխալ է.',
    'present' => 'դաշտը պետք է ներկա լինի.',
    'prohibited' => 'դաշտն արգելված է.',
    'prohibited_if' => 'դաշտն արգելված է, երբ :other-ը :value է.',
    'prohibited_unless' => 'դաշտն արգելված է, եթե :other -ը :values -ում չէ․',
    'prohibits' => 'դաշտն արգելում է :other-ին ներկա լինել․',
    'regex' => 'ձևաչափն անվավեր է.',
    'required' => 'Դաշտը պարտադիր է լրացման համար.',
    'required_array_keys' => 'դաշտը պետք է պարունակի գրառումներ՝ :values-ի համար.',
    'required_if' => 'դաշտը պարտադիր է, երբ :other-ը :value է.',
    'required_unless' => 'դաշտը պարտադիր է, եթե :other-ը :values-ում չէ.',
    'required_with' => 'դաշտը պարտադիր է, երբ առկա է :values.',
    'required_with_all' => 'դաշտը պարտադիր է, երբ առկա են :values.',
    'required_without' => 'դաշտը պարտադիր է, երբ :values ​​չկա.',
    'required_without_all' => 'դաշտը պարտադիր է, երբ :value-ներից ոչ մեկը չկա.',
    'same' => 'դաշտերը պետք է համապատասխանեն.',
    'size' => [
        'numeric' => 'դաշտը պետք է լինի :size.',
        'file' => 'դաշտը պետք է լինի :size կիլոբայթ.',
        'string' => 'դաշտը պետք է լինի :size նիշ.',
        'array' => 'դաշտը պետք է պարունակի :size տարրեր.',
    ],
    'starts_with' => 'դաշտը պետք է սկսվի հետևյալներից մեկով. :values.',
    'string' => 'Դաշտը պետք է լինի տող.',
    'timezone' => 'դաշտը պետք է լինի վավեր ժամային գոտի.',
    'unique' => 'Նման տվյալով օգտատեր արդեն արդեն գոյություն ունի',
    'uploaded' => 'դաշտը չհաջողվեց վերբեռնել.',
    'url' => 'դաշտը պետք է վավեր URL լինի.',
    'uuid' => 'դաշտը պետք է լինի վավեր UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
