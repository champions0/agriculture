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

    'accepted' => ':attribute - հատկանիշը պետք է ընդունվի',
    'accepted_if' => ':attribute - հատկանիշը պետք է ընդունվի երբ :other հավասար է :value.',
    'active_url' => ':attribute - վավեր հղում չէ',
    'after' => ':attribute - հատկանիշը պետք է լինի ամսաթիվ :date -ից հետո.',
    'after_or_equal' => ':attribute - հատկանիշը պետք է լինի ամսաթիվ :date -ից հետո կամ հավասար',
    'alpha' => ':attribute - պետք է պարունակի միայն տառեր.',
    'alpha_dash' => ':attribute - պետք է պարունակի միայն տառեր, թվեր, գծիկներ և ընդգծումներ.',
    'alpha_num' => ':attribute - պետք է պարունակի միայն տառեր և թվեր.',
    'array' => ':attribute - պետք է լինի զանգված.',
    'before' => ':attribute - պետք է լինի ամսաթիվ մինջև :date.',
    'before_or_equal' => ':attribute  - պետք է լինի ամսաթիվ մինջև :date , կամ հավասար.',
    'between' => [
        'numeric' => ':attribute պետք է լինի :min -ից :max -ի միջև.',
        'file' => ':attribute պետք է լինի :min և :max կիլոբայթների միջև.',
        'string' => ':attribute պետք է լինի :min և :max նիշերի միջև.',
        'array' => ':attribute պետք է ունենա :min և :max տարրերի միջև.',
    ],
    'boolean' => ':attribute դաշտը պետք է լինի ճշմարիտ կամ կեղծ.',
    'confirmed' => ':attribute հաստատումը չի համընկնում.',
    'current_password' => 'Գաղտնաբառը սխալ է.',
    'date' => ':attribute վավեր ամսաթիվ չէ.',
    'date_equals' => ':attribute պետք է լինի :date -ին հավասար ամսաթիվ․',
    'date_format' => ':attribute հատկանիշը չի համապատասխանում :format ֆորմատին.',
    'declined' => ':attribute պետք է մերժել.',
    'declined_if' => ':attribute - պետք է մերժվի, երբ  :other -ը :value է.',
    'different' => ':attribute և :other պետք է տարբեր լինեն.',
    'digits' => ':attribute պետք է լինեն :digits թվեր.',
    'digits_between' => ':attribute պետք է լինի :min և :max թվանշանների միջև.',
    'dimensions' => ':attribute ունի պատկերի անվավեր չափեր.',
    'distinct' => ':attribute դաշտն ունի կրկնօրինակ արժեք.',
    'email' => 'Դաշտը պետք է վավեր էլ փոստի հասցե լինի.',
    'ends_with' => ':attribute պետք է ավարտվի հետևյալներից մեկով :values.',
    'enum' => 'Ընտրված :attribute անվավեր է.',


    'exists' => ':attribute դաշտը անվավեր է.',
    'file' => ':attribute դաշտը պետք է լինի ֆայլ.',
    'filled' => ':attribute դաշտը պետք է արժեք ունենա.',
    'gt' => [
        'numeric' => ':attribute դաշտը պետք է լինի :value -ից մեծ.',
        'file' => ' :attribute դաշտը պետք է լինի :value կիլոբայթից մեծ.',
        'string' => ':attribute դաշտը պետք է լինի :value նիշերից.',
        'array' => ':attribute պետք է ունենա ավելի քան :value տարրեր.',
    ],
    'gte' => [
        'numeric' => ':attribute դաշտը պետք է մեծ կամ հավասար լինի :value -ին.',
        'file' => ':attribute դաշտը պետք է մեծ կամ հավասար լինի :value կիլոբայթին.',
        'string' => ':attribute դաշտը պետք է մեծ կամ հավասար լինի :value նիշերին.',
        'array' => ':attribute դաշտը պետք է ունենա :value տարրեր կամ ավելին.',
    ],
    'image' => ':attribute պետք է լինի պատկեր.',
    'in' => 'Ընտրված :attribute անվավեր է.',
    'in_array' => ':attribute դաշտը գոյություն չունի :other -ում.',
    'integer' => ':attribute պետք է լինի ամբողջ թիվ.',
    'ip' => ':attribute պետք է լինի վավեր IP հասցե.',
    'ipv4' => ':attribute պետք է լինի վավեր IPv4 հասցե.',
    'ipv6' => ':attribute պետք է լինի վավեր IPv6 հասցե.',
    'json' => ':attribute պետք է լինի վավեր JSON տող.',
    'lt' => [
        'numeric' => ':attribute պետք է լինի :value -ից փոքր.',
        'file' => ':attribute պետք է լինի :value կիլոբայթից պակաս.',
        'string' => ':attribute պետք է լինի :value նիշերից պակաս.',
        'array' => ':attribute պետք է ունենա  :value -ից պակաս տարրեր.',
    ],
    'lte' => [
        'numeric' => ':attribute պետք է լինի փոքր կամ հավասար :value-ին.',
        'file' => ':attribute պետք է փոքր կամ հավասար լինի :value կիլոբայթին.',
        'string' => ':attribute պետք է լինի փոքր կամ հավասար :value նիշերին.',
        'array' => ':attribute չպետք է ունենա ավելի քան :value տարրեր.',
    ],
    'mac_address' => ':attribute պետք է լինի վավեր MAC հասցե.',
    'max' => [
        'numeric' => ':attribute չպետք է ավելի մեծ լինի, քան :max.',
        'file' => ':attribute չպետք է ավելի մեծ լինի, քան :max կիլոբայթին.',
        'string' => ':attribute չպետք է ավելի մեծ լինի, քան :max նիշերին.',
        'array' => ':attribute չպետք է ունենա ավելի քան :max տարրեր.',
    ],
    'mimes' => ':attribute պետք է լինի type: :values տեսակի ֆայլ.',
    'mimetypes' => ':attribute պետք է լինի type: :values տեսակի ֆայլ.',
    'min' => [
        'numeric' => ':attribute պետք է լինի առնվազն :min.',
        'file' => 'Ֆայլը պետք է լինի առնվազն :min կիլոբայթ.',
        'string' => ':attribute պետք է լինի առնվազն :min նիշ.',
        'array' => ':attribute պետք է ունենա առնվազն :min տարրեր.',
    ],
    'multiple_of' => ':attribute պետք է լինի :value -ի բազմապատիկ.',
    'not_in' => 'Ընտրված :attribute անվավեր է.',
    'not_regex' => ':attribute ձևաչափն անվավեր է.',
    'numeric' => 'Դաշտը պետք է լինի թիվ.',
    'password' => 'Գաղտնաբառը սխալ է.',
    'present' => ':attribute դաշտը պետք է ներկա լինի.',
    'prohibited' => ':attribute դաշտն արգելված է.',
    'prohibited_if' => ':attribute դաշտն արգելված է, երբ :other-ը :value է.',
    'prohibited_unless' => ':attribute դաշտն արգելված է, եթե :other -ը :values -ում չէ․',
    'prohibits' => ':attribute դաշտն արգելում է :other-ին ներկա լինել․',
    'regex' => ':attribute ձևաչափն անվավեր է.',
    'required' => 'Դաշտը պարտադիր է լրացման համար.',
    'required_array_keys' => ':attribute դաշտը պետք է պարունակի գրառումներ՝ :values-ի համար.',
    'required_if' => ':attribute դաշտը պարտադիր է, երբ :other-ը :value է.',
    'required_unless' => ':attribute դաշտը պարտադիր է, եթե :other-ը :values-ում չէ.',
    'required_with' => ':attribute դաշտը պարտադիր է, երբ առկա է :values.',
    'required_with_all' => ':attribute դաշտը պարտադիր է, երբ առկա են :values.',
    'required_without' => ':attribute դաշտը պարտադիր է, երբ :values ​​չկա.',
    'required_without_all' => ':attribute դաշտը պարտադիր է, երբ :value-ներից ոչ մեկը չկա.',
    'same' => ':attribute և :other պետք է համապատասխանեն.',
    'size' => [
        'numeric' => ':attribute-ը պետք է լինի :size.',
        'file' => ':attribute-ը պետք է լինի :size կիլոբայթ.',
        'string' => ':attribute-ը պետք է լինի :size նիշ.',
        'array' => ':attribute-ը պետք է պարունակի :size տարրեր.',
    ],
    'starts_with' => ':attribute-ը պետք է սկսվի հետևյալներից մեկով. :values.',
    'string' => 'Դաշտը պետք է լինի տող.',
    'timezone' => ':attribute-ը պետք է լինի վավեր ժամային գոտի.',
    'unique' => 'Նման տվյալով օգտատեր արդեն արդեն գոյություն ունի',
    'uploaded' => ':attribute-ը չհաջողվեց վերբեռնել.',
    'url' => ':attribute-ը պետք է վավեր URL լինի.',
    'uuid' => ':attribute-ը պետք է լինի վավեր UUID.',

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
