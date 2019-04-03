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

    'accepted'             => ':attribute須被接受!',
    'active_url'           => ':attribute不是有效的連結!',
    'after'                => ':attribute須為在 :date 之後的日期!',
    'after_or_equal'       => ':attribute須為在 :date 一樣或之後的日期!',
    'alpha'                => ':attribute只包含字母!',
    'alpha_dash'           => ':attribute只包含字母、數字、破折號!',
    'alpha_num'            => ':attribute只包含字母和數字!',
    'array'                => ':attribute須為一個陣列!',
    'before'               => ':attribute需在 :date 之前的日期!',
    'before_or_equal'      => ':attribute須為在 :date 一樣或之前的日期!',
    'between'              => [
        'numeric' => ':attribute需在 :min 到 :max 之間!',
        'file'    => ':attribute需在 :min 到 :max kilobytes(KB) 之間!',
        'string'  => ':attribute需在 :min 到 :max 長度之間!',
        'array'   => ':attribute需在 :min 到 :max 項目之間!',
    ],
    'boolean'              => ':attribute須為 true 或 false!',
    'confirmed'            => ':attribute輸入錯誤!',
    'date'                 => ':attribute不為一個有效的日期!',
    'date_format'          => ':attribute不符合 :format 的格式!',
    'different'            => ':attribute和 :other 須為不相同!',
    'digits'               => ':attribute須為 :digits 位數!',
    'digits_between'       => ':attribute需在 :min 到 :max 之間的位數!',
    'dimensions'           => ':attribute圖像尺寸不符合!',
    'distinct'             => ':attribute已重複!',
    'email'                => ':attribute須為有效的郵件地址!',
    'exists'               => '選中的:attribute為無效!',
    'file'                 => ':attribute須為一個檔案!',
    'filled'               => ':attribute需有值!',
    'image'                => ':attribute須為一個圖檔!',
    'in'                   => '選中的:attribute為無效!',
    'in_array'             => ':attribute在 :other 不存在!',
    'integer'              => ':attribute須為整數!',
    'ip'                   => ':attribute須為有效的IP地址!',
    'json'                 => ':attribute須為有效的JSON字串!',
    'max'                  => [
        'numeric' => ':attribute不能超過 :max!',
        'file'    => ':attribute不能超過 :max kilobytes(KB)!',
        'string'  => ':attribute不能超過 :max 長度!',
        'array'   => ':attribute不能超過 :max 項目!',
    ],
    'mimes'                => ':attribute須為: :values 的文件類型!',
    'mimetypes'            => ':attribute須為: :values 的文件類型!',
    'min'                  => [
        'numeric' => ':attribute不能少於 :min!',
        'file'    => ':attribute不能少於 :min kilobytes(KB)!',
        'string'  => ':attribute不能少於 :min 長度!',
        'array'   => ':attribute不能少於 :min 項目!',
    ],
    'not_in'               => '選中的:attribute為無效!',
    'numeric'              => ':attribute須為數字!',
    'present'              => ':attribute須為存在!',
    'regex'                => ':attribute格式為無效!',
    'required'             => ':attribute是必須的!',
    'required_if'          => ':attribute在 :other 為 :value 時是必須的!',
    'required_unless'      => ':attribute低於 :other 在 :values 時是必需的!',
    'required_with'        => ':attribute當 :values 為存在時是必需的!',
    'required_with_all'    => ':attribute當 :values 為存在時是必需的!',
    'required_without'     => ':attribute當 :values 不存在時是必需的!',
    'required_without_all' => ':attribute當沒有一個為 :values 的值存在時是必需的!',
    'same'                 => ':attribute和 :other 需匹配!',
    'size'                 => [
        'numeric' => ':attribute須為 :size!',
        'file'    => ':attribute須為 :size kilobytes(KB)!',
        'string'  => ':attribute須為 :size 大小!',
        'array'   => ':attribute須包含 :size 項目!',
    ],
    'string'               => ':attribute須為一個字串!',
    'timezone'             => ':attribute須為一個有效範圍!',
    'unique'               => ':attribute已經使用!',
    'uploaded'             => ':attribute上傳失敗!',
    'url'                  => ':attribute格式不符合',

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

    'attributes' => [
        'name' => '暱稱',
        'password' => '密碼',
        'email' => '郵件信箱',
        'password_confirmation' => '密碼',
    ],

];
