{!! Field::select('type', ['product' => __('Product'), 'service' => __('Service')]) !!}
{!! Field::text('code', null, ['ph' => __('Code')]) !!}
{!! Field::text('name', null, ['ph' => __('Name')]) !!}
{!! Field::text('price', null, ['ph' => __('Price')]) !!}