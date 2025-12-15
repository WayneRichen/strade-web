<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 驗證語系訊息
    |--------------------------------------------------------------------------
    |
    | 以下語系內容為 Validator 類別預設使用的錯誤訊息。
    | 部分規則（例如 size）會依不同型別有多種版本，
    | 你可以在這裡自由調整每一則訊息。
    |
    */

    'accepted' => ':attribute 欄位必須被接受。',
    'accepted_if' => '當 :other 為 :value 時，:attribute 欄位必須被接受。',
    'active_url' => ':attribute 欄位必須是有效的 URL。',
    'after' => ':attribute 欄位必須是晚於 :date 的日期。',
    'after_or_equal' => ':attribute 欄位必須是等於或晚於 :date 的日期。',
    'alpha' => ':attribute 欄位只能包含英文字母。',
    'alpha_dash' => ':attribute 欄位只能包含英文字母、數字、破折號及底線。',
    'alpha_num' => ':attribute 欄位只能包含英文字母與數字。',
    'any_of' => ':attribute 欄位的值無效。',
    'array' => ':attribute 欄位必須為陣列。',
    'ascii' => ':attribute 欄位只能包含單位元的英數字元與符號。',
    'before' => ':attribute 欄位必須是早於 :date 的日期。',
    'before_or_equal' => ':attribute 欄位必須是等於或早於 :date 的日期。',
    'between' => [
        'array' => ':attribute 欄位必須介於 :min 到 :max 個項目之間。',
        'file' => ':attribute 欄位大小必須介於 :min 到 :max KB 之間。',
        'numeric' => ':attribute 欄位的值必須介於 :min 到 :max 之間。',
        'string' => ':attribute 欄位長度必須介於 :min 到 :max 個字元之間。',
    ],
    'boolean' => ':attribute 欄位必須為 true 或 false。',
    'can' => ':attribute 欄位包含未授權的值。',
    'confirmed' => ':attribute 欄位的確認內容不一致。',
    'contains' => ':attribute 欄位缺少必要的值。',
    'current_password' => '密碼錯誤。',
    'date' => ':attribute 欄位必須是有效的日期。',
    'date_equals' => ':attribute 欄位必須是等於 :date 的日期。',
    'date_format' => ':attribute 欄位格式必須符合 :format。',
    'decimal' => ':attribute 欄位必須有 :decimal 位小數。',
    'declined' => ':attribute 欄位必須被拒絕。',
    'declined_if' => '當 :other 為 :value 時，:attribute 欄位必須被拒絕。',
    'different' => ':attribute 欄位與 :other 欄位必須不同。',
    'digits' => ':attribute 欄位必須是 :digits 位數。',
    'digits_between' => ':attribute 欄位位數必須介於 :min 到 :max 位之間。',
    'dimensions' => ':attribute 欄位的圖片尺寸不正確。',
    'distinct' => ':attribute 欄位包含重複的值。',
    'doesnt_contain' => ':attribute 欄位不得包含以下任一值：:values。',
    'doesnt_end_with' => ':attribute 欄位不得以下列任一值結尾：:values。',
    'doesnt_start_with' => ':attribute 欄位不得以下列任一值開頭：:values。',
    'email' => ':attribute 欄位必須是有效的電子郵件地址。',
    'ends_with' => ':attribute 欄位必須以下列任一值結尾：:values。',
    'enum' => '所選的 :attribute 無效。',
    'exists' => '所選的 :attribute 無效。',
    'extensions' => ':attribute 欄位的副檔名必須是以下其中之一：:values。',
    'file' => ':attribute 欄位必須是檔案。',
    'filled' => ':attribute 欄位必須有值。',
    'gt' => [
        'array' => ':attribute 欄位必須多於 :value 個項目。',
        'file' => ':attribute 欄位大小必須大於 :value KB。',
        'numeric' => ':attribute 欄位的值必須大於 :value。',
        'string' => ':attribute 欄位長度必須大於 :value 個字元。',
    ],
    'gte' => [
        'array' => ':attribute 欄位必須至少有 :value 個項目。',
        'file' => ':attribute 欄位大小必須大於或等於 :value KB。',
        'numeric' => ':attribute 欄位的值必須大於或等於 :value。',
        'string' => ':attribute 欄位長度必須大於或等於 :value 個字元。',
    ],
    'hex_color' => ':attribute 欄位必須是有效的十六進位色碼。',
    'image' => ':attribute 欄位必須是圖片。',
    'in' => '所選的 :attribute 無效。',
    'in_array' => ':attribute 欄位必須存在於 :other 中。',
    'in_array_keys' => ':attribute 欄位必須至少包含以下其中一個鍵值：:values。',
    'integer' => ':attribute 欄位必須是整數。',
    'ip' => ':attribute 欄位必須是有效的 IP 位址。',
    'ipv4' => ':attribute 欄位必須是有效的 IPv4 位址。',
    'ipv6' => ':attribute 欄位必須是有效的 IPv6 位址。',
    'json' => ':attribute 欄位必須是有效的 JSON 字串。',
    'list' => ':attribute 欄位必須是清單。',
    'lowercase' => ':attribute 欄位必須為小寫。',
    'lt' => [
        'array' => ':attribute 欄位必須少於 :value 個項目。',
        'file' => ':attribute 欄位大小必須小於 :value KB。',
        'numeric' => ':attribute 欄位的值必須小於 :value。',
        'string' => ':attribute 欄位長度必須小於 :value 個字元。',
    ],
    'lte' => [
        'array' => ':attribute 欄位不得超過 :value 個項目。',
        'file' => ':attribute 欄位大小必須小於或等於 :value KB。',
        'numeric' => ':attribute 欄位的值必須小於或等於 :value。',
        'string' => ':attribute 欄位長度必須小於或等於 :value 個字元。',
    ],
    'mac_address' => ':attribute 欄位必須是有效的 MAC 位址。',
    'max' => [
        'array' => ':attribute 欄位不得超過 :max 個項目。',
        'file' => ':attribute 欄位大小不得大於 :max KB。',
        'numeric' => ':attribute 欄位的值不得大於 :max。',
        'string' => ':attribute 欄位長度不得大於 :max 個字元。',
    ],
    'max_digits' => ':attribute 欄位不得超過 :max 位數。',
    'mimes' => ':attribute 欄位必須是以下類型的檔案：:values。',
    'mimetypes' => ':attribute 欄位必須是以下 MIME 類型的檔案：:values。',
    'min' => [
        'array' => ':attribute 欄位至少需要 :min 個項目。',
        'file' => ':attribute 欄位大小至少需要 :min KB。',
        'numeric' => ':attribute 欄位的值至少需要 :min。',
        'string' => ':attribute 欄位長度至少需要 :min 個字元。',
    ],
    'min_digits' => ':attribute 欄位至少需要 :min 位數。',
    'missing' => ':attribute 欄位必須不存在。',
    'missing_if' => '當 :other 為 :value 時，:attribute 欄位必須不存在。',
    'missing_unless' => '除非 :other 為 :value，否則 :attribute 欄位必須不存在。',
    'missing_with' => '當 :values 存在時，:attribute 欄位必須不存在。',
    'missing_with_all' => '當 :values 全部存在時，:attribute 欄位必須不存在。',
    'multiple_of' => ':attribute 欄位必須是 :value 的倍數。',
    'not_in' => '所選的 :attribute 無效。',
    'not_regex' => ':attribute 欄位格式不正確。',
    'numeric' => ':attribute 欄位必須是數字。',
    'password' => [
        'letters' => ':attribute 欄位至少需要包含一個字母。',
        'mixed' => ':attribute 欄位至少需要包含一個大寫字母與一個小寫字母。',
        'numbers' => ':attribute 欄位至少需要包含一個數字。',
        'symbols' => ':attribute 欄位至少需要包含一個符號。',
        'uncompromised' => '此 :attribute 曾出現在資料外洩事件中，請更換其他 :attribute。',
    ],
    'present' => ':attribute 欄位必須存在。',
    'present_if' => '當 :other 為 :value 時，:attribute 欄位必須存在。',
    'present_unless' => '除非 :other 為 :value，否則 :attribute 欄位必須存在。',
    'present_with' => '當 :values 存在時，:attribute 欄位必須存在。',
    'present_with_all' => '當 :values 全部存在時，:attribute 欄位必須存在。',
    'prohibited' => ':attribute 欄位被禁止使用。',
    'prohibited_if' => '當 :other 為 :value 時，:attribute 欄位被禁止使用。',
    'prohibited_if_accepted' => '當 :other 被接受時，:attribute 欄位被禁止使用。',
    'prohibited_if_declined' => '當 :other 被拒絕時，:attribute 欄位被禁止使用。',
    'prohibited_unless' => '除非 :other 在 :values 之中，否則 :attribute 欄位被禁止使用。',
    'prohibits' => ':attribute 欄位禁止 :other 欄位存在。',
    'regex' => ':attribute 欄位格式不正確。',
    'required' => ':attribute 欄位為必填。',
    'required_array_keys' => ':attribute 欄位必須包含以下鍵值：:values。',
    'required_if' => '當 :other 為 :value 時，:attribute 欄位為必填。',
    'required_if_accepted' => '當 :other 被接受時，:attribute 欄位為必填。',
    'required_if_declined' => '當 :other 被拒絕時，:attribute 欄位為必填。',
    'required_unless' => '除非 :other 在 :values 之中，否則 :attribute 欄位為必填。',
    'required_with' => '當 :values 存在時，:attribute 欄位為必填。',
    'required_with_all' => '當 :values 全部存在時，:attribute 欄位為必填。',
    'required_without' => '當 :values 不存在時，:attribute 欄位為必填。',
    'required_without_all' => '當 :values 全部不存在時，:attribute 欄位為必填。',
    'same' => ':attribute 欄位必須與 :other 欄位相同。',
    'size' => [
        'array' => ':attribute 欄位必須包含 :size 個項目。',
        'file' => ':attribute 欄位大小必須為 :size KB。',
        'numeric' => ':attribute 欄位的值必須為 :size。',
        'string' => ':attribute 欄位長度必須為 :size 個字元。',
    ],
    'starts_with' => ':attribute 欄位必須以下列任一值開頭：:values。',
    'string' => ':attribute 欄位必須是字串。',
    'timezone' => ':attribute 欄位必須是有效的時區。',
    'unique' => ':attribute 已經被使用過。',
    'uploaded' => ':attribute 上傳失敗。',
    'uppercase' => ':attribute 欄位必須為大寫。',
    'url' => ':attribute 欄位必須是有效的 URL。',
    'ulid' => ':attribute 欄位必須是有效的 ULID。',
    'uuid' => ':attribute 欄位必須是有效的 UUID。',

    /*
    |--------------------------------------------------------------------------
    | 自訂驗證語系訊息
    |--------------------------------------------------------------------------
    |
    | 你可以使用 "attribute.rule" 的命名方式，
    | 為特定欄位與規則指定專屬的錯誤訊息。
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 自訂驗證欄位名稱
    |--------------------------------------------------------------------------
    |
    | 以下語系內容用來將 :attribute 取代成較友善的名稱，
    | 例如將 "email" 顯示為 "電子郵件"。
    |
    */

    'attributes' => [],

];
