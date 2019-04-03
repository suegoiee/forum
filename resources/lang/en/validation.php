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

    'accepted'             => '此 :attribute 須被接受!',
    'active_url'           => '此 :attribute 不是有效的連結!',
    'after'                => '此 :attribute 須為在 :date 之後的日期!',
    'after_or_equal'       => '此 :attribute 須為在 :date 一樣或之後的日期!',
    'alpha'                => '此 :attribute 只包含字母!',
    'alpha_dash'           => '此 :attribute 只包含字母、字母、破折號!',
    'alpha_num'            => '此 :attribute 只包含字母和數字!',
    'array'                => '此 :attribute 須為一個陣列!',
    'before'               => '此 :attribute 需在 :date 之前的日期!',
    'before_or_equal'      => '此 :attribute 須為在 :date 一樣或之前的日期!',
    'between'              => [
        'numeric' => '此 :attribute 需在 :min 到 :max 之間!',
        'file'    => '此 :attribute 需在 :min 到 :max kilobytes(KB) 之間!',
        'string'  => '此 :attribute 需在 :min 到 :max 字串之間!',
        'array'   => '此 :attribute 需在 :min 到 :max 項目之間!',
    ],
    'boolean'              => '此 :attribute 須為 true 或 false!',
    'confirmed'            => '此 :attribute 驗證不符合!',
    'date'                 => '此 :attribute 不為一個有效的日期!',
    'date_format'          => '此 :attribute 不符合 :format 的格式!',
    'different'            => '此 :attribute 和 :other 須為不相同!',
    'digits'               => '此 :attribute 須為 :digits 位數!',
    'digits_between'       => '此 :attribute 需在 :min 到 :max 之間的位數!',
    'dimensions'           => '此 :attribute 圖像尺寸不符合!',
    'distinct'             => '此 :attribute 已重複!',
    'email'                => '此 :attribute 須為有效的郵件地址!',
    'exists'               => '此 選中的 :attribute 為無效!',
    'file'                 => '此 :attribute 須為一個檔案!',
    'filled'               => '此 :attribute 需有值!',
    'image'                => '此 :attribute 須為一個圖檔!',
    'in'                   => '此 選中的 :attribute 為無效!',
    'in_array'             => '此 :attribute 在 :other 不存在!',
    'integer'              => '此 :attribute 須為整數!',
    'ip'                   => '此 :attribute 須為有效的IP地址!',
    'json'                 => '此 :attribute 須為有效的JSON字串!',
    'max'                  => [
        'numeric' => '此 :attribute 不能超過 :max!',
        'file'    => '此 :attribute 不能超過 :max kilobytes(KB)!',
        'string'  => '此 :attribute 不能超過 :max 字串!',
        'array'   => '此 :attribute 不能超過 :max 項目!',
    ],
    'mimes'                => '此 :attribute 須為: :values 的文件類型!',
    'mimetypes'            => '此 :attribute 須為: :values 的文件類型!',
    'min'                  => [
        'numeric' => '此 :attribute 不能低過 :max!',
        'file'    => '此 :attribute 不能低過 :max kilobytes(KB)!',
        'string'  => '此 :attribute 不能低過 :max 字串!',
        'array'   => '此 :attribute 不能低過 :max 項目!',
    ],
    'not_in'               => '此 選中的 :attribute 為無效!',
    'numeric'              => '此 :attribute 須為數字!',
    'present'              => '此 :attribute 須為存在!',
    'regex'                => '此 :attribute 格式為無效!',
    'required'             => '此 :attribute 是必須的!',
    'required_if'          => '此 :attribute 在 :other 為 :value 時是必須的!',
    'required_unless'      => '此 :attribute 低於 :other 在 :values 時是必需的!',
    'required_with'        => '此 :attribute 當 :values 為存在時是必需的!',
    'required_with_all'    => '此 :attribute 當 :values 為存在時是必需的!',
    'required_without'     => '此 :attribute 當 :values 不存在時是必需的!',
    'required_without_all' => '此 :attribute 當沒有一個為 :values 的值存在時是必需的!',
    'same'                 => '此 :attribute 和 :other 需匹配!',
    'size'                 => [
        'numeric' => '此 :attribute 須為 :size!',
        'file'    => '此 :attribute 須為 :size kilobytes(KB)!',
        'string'  => '此 :attribute 須為 :size 字串!',
        'array'   => '此 :attribute 須包含 :size 項目!',
    ],
    'string'               => '此 :attribute 須為一個字串!',
    'timezone'             => '此 :attribute 須為一個有效範圍!',
    'unique'               => '此 :attribute 已經使用!',
    'uploaded'             => '此 :attribute 上傳失敗!',
    'url'                  => '此 :attribute 格式不符合',

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
            'rule-name' => '規定:',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
